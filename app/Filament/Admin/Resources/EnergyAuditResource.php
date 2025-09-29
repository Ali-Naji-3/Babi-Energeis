<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EnergyAuditResource\Pages;
use App\Filament\Admin\Resources\EnergyAuditResource\RelationManagers;
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
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('technician_id')
                    ->numeric(),
                Forms\Components\TextInput::make('property_type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('property_address')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('property_size')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('current_energy_usage')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('audit_date')
                    ->required(),
                Forms\Components\TextInput::make('audit_status')
                    ->required(),
                Forms\Components\TextInput::make('recommendations'),
                Forms\Components\TextInput::make('estimated_savings')
                    ->numeric(),
                Forms\Components\TextInput::make('report_file')
                    ->maxLength(255),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('technician_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('property_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('property_size')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('current_energy_usage')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('audit_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('audit_status'),
                Tables\Columns\TextColumn::make('estimated_savings')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('report_file')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
