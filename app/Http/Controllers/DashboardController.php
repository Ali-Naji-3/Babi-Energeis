<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EnergyAudit;
use App\Models\MaintenanceVisit;
use App\Models\Technician;
use App\Models\Order;
use App\Models\SolarInstallation;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get dashboard statistics
        $stats = $this->getDashboardStats($user);
        
        return view('dashboard', $stats);
    }

    public function getStats(Request $request)
    {
        $user = Auth::user();
        $stats = $this->getDashboardStats($user);
        
        return response()->json($stats);
    }

    private function getDashboardStats($user)
    {
        // Energy Audits Statistics
        $auditQuery = EnergyAudit::where('user_id', $user->id);
        $auditCount = $auditQuery->count();
        $scheduledAudits = $auditQuery->where('audit_status', 'scheduled')->count();
        $inProgressAudits = $auditQuery->where('audit_status', 'in_progress')->count();
        $completedAudits = $auditQuery->where('audit_status', 'completed')->count();

        // Solar Installations Statistics
        $installationQuery = SolarInstallation::where('user_id', $user->id);
        $installationCount = $installationQuery->count();
        $activeInstallations = $installationQuery->whereIn('status', ['quoted', 'approved', 'in_progress'])->count();
        $completedInstallations = $installationQuery->where('status', 'completed')->count();

        // Maintenance Visits Statistics
        $maintenanceQuery = MaintenanceVisit::whereHas('solarInstallation', function($query) use ($user) {
            $query->where('user_id', $user->id);
        });
        $maintenanceCount = $maintenanceQuery->count();
        $upcomingVisits = $maintenanceQuery->where('visit_date', '>=', now())
            ->where('status', 'scheduled')->count();
        $pendingVisits = $maintenanceQuery->where('status', 'scheduled')->count();
        $completedVisits = $maintenanceQuery->where('status', 'completed')->count();

        // Orders Statistics
        $orderQuery = Order::where('user_id', $user->id);
        $orderCount = $orderQuery->count();
        $pendingOrders = $orderQuery->where('status', 'pending')->count();
        $completedOrders = $orderQuery->where('status', 'completed')->count();

        return [
            'auditCount' => $auditCount,
            'scheduledAudits' => $scheduledAudits,
            'inProgressAudits' => $inProgressAudits,
            'completedAudits' => $completedAudits,
            'installationCount' => $installationCount,
            'activeInstallations' => $activeInstallations,
            'completedInstallations' => $completedInstallations,
            'maintenanceCount' => $maintenanceCount,
            'upcomingVisits' => $upcomingVisits,
            'pendingVisits' => $pendingVisits,
            'completedVisits' => $completedVisits,
            'orderCount' => $orderCount,
            'pendingOrders' => $pendingOrders,
            'completedOrders' => $completedOrders,
        ];
    }

    public function getRecentActivity()
    {
        $user = Auth::user();
        
        $activities = collect();

        // Get recent energy audits
        $recentAudits = EnergyAudit::where('user_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function($audit) {
                return [
                    'type' => 'audit',
                    'title' => 'Energy Audit ' . ucfirst($audit->audit_status),
                    'description' => 'Audit at ' . $audit->property_address,
                    'date' => $audit->updated_at,
                    'status' => $audit->audit_status,
                    'technician' => $audit->technician?->user?->name ?? 'Unassigned'
                ];
            });

        // Get recent maintenance visits
        $recentMaintenance = MaintenanceVisit::whereHas('solarInstallation', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->orderBy('updated_at', 'desc')
        ->limit(5)
        ->get()
        ->map(function($visit) {
            return [
                'type' => 'maintenance',
                'title' => 'Maintenance ' . ucfirst($visit->status),
                'description' => ucfirst($visit->visit_type) . ' visit scheduled',
                'date' => $visit->updated_at,
                'status' => $visit->status,
                'technician' => $visit->technician?->user?->name ?? 'Unassigned'
            ];
        });

        // Get recent orders
        $recentOrders = Order::where('user_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function($order) {
                return [
                    'type' => 'order',
                    'title' => 'Order ' . ucfirst($order->status),
                    'description' => 'Order #' . $order->order_number,
                    'date' => $order->updated_at,
                    'status' => $order->status,
                    'technician' => null
                ];
            });

        $activities = $activities
            ->merge($recentAudits)
            ->merge($recentMaintenance)
            ->merge($recentOrders)
            ->sortByDesc('date')
            ->take(10);

        return response()->json($activities->values());
    }
}