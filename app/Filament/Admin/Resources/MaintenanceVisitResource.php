<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MaintenanceVisitResource\Pages;
use App\Filament\Admin\Resources\MaintenanceVisitResource\RelationManagers;
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
                Forms\Components\TextInput::make('solar_installation_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('technician_id')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('visit_date')
                    ->required(),
                Forms\Components\TextInput::make('visit_type')
                    ->required(),
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('photos'),
                Forms\Components\TextInput::make('parts_used'),
                Forms\Components\TextInput::make('cost')
                    ->required()
                    ->numeric()
                    ->default(0.00)
                    ->prefix('$'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('solar_installation_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('technician_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('visit_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('visit_type'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('cost')
                    ->money()
                    ->sortable(),
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
            'index' => Pages\ListMaintenanceVisits::route('/'),
            'create' => Pages\CreateMaintenanceVisit::route('/create'),
            'edit' => Pages\EditMaintenanceVisit::route('/{record}/edit'),
        ];
    }
}
