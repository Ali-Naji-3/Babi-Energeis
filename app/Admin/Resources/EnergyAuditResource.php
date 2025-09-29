<?php

namespace App\Admin\Resources;

use App\Admin\Resources\EnergyAuditResource\Pages;
use App\Admin\Resources\EnergyAuditResource\RelationManagers;
use App\Models\EnergyAudit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EnergyAuditResource extends Resource
{
    protected static ?string $model = EnergyAudit::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Customer')
                    ->relationship('user', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->name} - {$record->email}")
                    ->searchable()
                    ->preload()
                    ->required(),
                
                Forms\Components\Select::make('technician_id')
                    ->label('Technician')
                    ->relationship('technician', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->employee_name} - {$record->specialization}")
                    ->searchable()
                    ->preload()
                    ->nullable(),
                
                Forms\Components\Select::make('property_type')
                    ->label('Property Type')
                    ->options([
                        'Residential Villa' => 'Residential Villa',
                        'Apartment Building' => 'Apartment Building',
                        'Commercial Building' => 'Commercial Building',
                        'Industrial Facility' => 'Industrial Facility',
                        'Office Building' => 'Office Building',
                        'Retail Store' => 'Retail Store',
                        'Restaurant' => 'Restaurant',
                        'Hotel' => 'Hotel',
                        'Hospital' => 'Hospital',
                        'School' => 'School',
                    ])
                    ->required()
                    ->searchable(),
                
                Forms\Components\Textarea::make('property_address')
                    ->label('Property Address')
                    ->required()
                    ->columnSpanFull()
                    ->rows(3)
                    ->placeholder('Enter full Lebanese address (e.g., Hamra Street, Beirut, Lebanon)'),
                
                Forms\Components\TextInput::make('property_size')
                    ->label('Property Size (sq ft)')
                    ->required()
                    ->numeric()
                    ->suffix('sq ft'),
                
                
                Forms\Components\DatePicker::make('audit_date')
                    ->label('Audit Date')
                    ->required()
                    ->native(false)
                    ->displayFormat('d/m/Y'),
                
                Forms\Components\Select::make('audit_status')
                    ->label('Audit Status')
                    ->options([
                        'scheduled' => 'Scheduled',
                        'in_progress' => 'In Progress',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->required()
                    ->default('scheduled'),
                
                
                Forms\Components\TextInput::make('estimated_savings')
                    ->label('Estimated Savings')
                    ->numeric()
                    ->prefix('$')
                    ->suffix('per year'),
                
                Forms\Components\FileUpload::make('report_file')
                    ->label('Audit Report')
                    ->acceptedFileTypes(['application/pdf'])
                    ->directory('audit-reports')
                    ->visibility('public'),
                
                Forms\Components\Textarea::make('notes')
                    ->label('Notes')
                    ->columnSpanFull()
                    ->rows(3)
                    ->placeholder('Additional notes about the energy audit...'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Customer')
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('technician.employee_name')
                    ->label('Technician')
                    ->sortable()
                    ->searchable()
                    ->placeholder('Unassigned'),
                
                Tables\Columns\TextColumn::make('technician.specialization')
                    ->label('Specialization')
                    ->sortable()
                    ->toggleable()
                    ->placeholder('N/A'),
                
                Tables\Columns\TextColumn::make('property_type')
                    ->label('Property Type')
                    ->searchable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Residential Villa' => 'success',
                        'Commercial Building' => 'info',
                        'Industrial Facility' => 'warning',
                        default => 'gray',
                    }),
                
                Tables\Columns\TextColumn::make('property_address')
                    ->label('Address')
                    ->limit(30)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 30 ? $state : null;
                    }),
                
                Tables\Columns\TextColumn::make('property_size')
                    ->label('Size')
                    ->numeric()
                    ->sortable()
                    ->suffix(' sq ft'),
                
                
                Tables\Columns\TextColumn::make('audit_date')
                    ->label('Audit Date')
                    ->date('d/m/Y')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('audit_status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'scheduled' => 'info',
                        'in_progress' => 'warning',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
                
                Tables\Columns\TextColumn::make('estimated_savings')
                    ->label('Savings')
                    ->money('USD')
                    ->sortable()
                    ->placeholder('N/A'),
                
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
            'index' => Pages\ListEnergyAudits::route('/'),
            'create' => Pages\CreateEnergyAudit::route('/create'),
            'edit' => Pages\EditEnergyAudit::route('/{record}/edit'),
        ];
    }
}
