<?php

namespace App\Admin\Resources;

use App\Admin\Resources\MaintenanceVisitResource\Pages;
use App\Admin\Resources\MaintenanceVisitResource\RelationManagers;
use App\Models\MaintenanceVisit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MaintenanceVisitResource extends Resource
{
    protected static ?string $model = MaintenanceVisit::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('solar_installation_id')
                    ->label('Solar Installation')
                    ->relationship('solarInstallation', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) => "Installation #{$record->id} - {$record->user->name}")
                    ->searchable()
                    ->preload()
                    ->required(),
                
                Forms\Components\Select::make('technician_id')
                    ->label('Technician')
                    ->relationship('technician', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->employee_name} - {$record->specialization}")
                    ->searchable()
                    ->preload()
                    ->required(),
                
                Forms\Components\Select::make('energy_audit_id')
                    ->label('Energy Audit')
                    ->relationship('energyAudit', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) => "Audit #{$record->id} - {$record->property_address}")
                    ->searchable()
                    ->preload()
                    ->nullable(),
                
                Forms\Components\DatePicker::make('visit_date')
                    ->label('Visit Date')
                    ->required()
                    ->native(false)
                    ->displayFormat('d/m/Y'),
                
                Forms\Components\Select::make('visit_type')
                    ->label('Visit Type')
                    ->options([
                        'routine' => 'Routine Maintenance',
                        'repair' => 'Repair',
                        'inspection' => 'Inspection',
                    ])
                    ->required(),
                
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'scheduled' => 'Scheduled',
                        'in_progress' => 'In Progress',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->required()
                    ->default('scheduled'),
                
                Forms\Components\Textarea::make('notes')
                    ->label('Notes')
                    ->columnSpanFull()
                    ->rows(3),
                
                Forms\Components\FileUpload::make('photos')
                    ->label('Photos')
                    ->multiple()
                    ->image()
                    ->directory('maintenance-photos')
                    ->visibility('public'),
                
                Forms\Components\Repeater::make('parts_used')
                    ->label('Parts Used')
                    ->schema([
                        Forms\Components\TextInput::make('part_name')
                            ->label('Part Name')
                            ->required(),
                        Forms\Components\TextInput::make('quantity')
                            ->label('Quantity')
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('cost')
                            ->label('Cost')
                            ->numeric()
                            ->prefix('$')
                            ->required(),
                    ])
                    ->columns(3)
                    ->collapsible(),
                
                Forms\Components\TextInput::make('cost')
                    ->label('Total Cost')
                    ->required()
                    ->numeric()
                    ->default(0.00)
                    ->prefix('$')
                    ->step(0.01),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('solar_installation_id')
                    ->label('Installation')
                    ->formatStateUsing(fn ($record) => "Installation #{$record->solar_installation_id}")
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('technician.employee_name')
                    ->label('Technician')
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('technician.specialization')
                    ->label('Specialization')
                    ->sortable()
                    ->toggleable(),
                
                Tables\Columns\TextColumn::make('visit_date')
                    ->label('Visit Date')
                    ->date('d/m/Y')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('visit_type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'routine' => 'success',
                        'repair' => 'danger',
                        'inspection' => 'info',
                        default => 'gray',
                    }),
                
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'scheduled' => 'info',
                        'in_progress' => 'warning',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
                
                Tables\Columns\TextColumn::make('cost')
                    ->label('Cost')
                    ->money('USD')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMaintenanceVisits::route('/'),
            'create' => Pages\CreateMaintenanceVisit::route('/create'),
            'edit' => Pages\EditMaintenanceVisit::route('/{record}/edit'),
        ];
    }
}
