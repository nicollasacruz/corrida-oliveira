<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
//use App\Filament\Resources\EventResource\RelationManagers;
use App\Filament\Resources\EventResource\RelationManagers\ParticipantsRelationManager;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->placeholder('Event Name'),
                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->required()
                    ->placeholder('Description'),
                Forms\Components\DatePicker::make('runnerDate')
                    ->label('Data da Corrida')
                    ->required()
                    ->placeholder('Data da Corrida'),
                Forms\Components\DatePicker::make('startDate')
                    ->label('Start Date')
                    ->required()
                    ->placeholder('Start Date'),
                Forms\Components\DatePicker::make('endDate')
                    ->label('End Date')
                    ->required()
                    ->placeholder('End Date'),
                Forms\Components\TextInput::make('location')
                    ->label('Location')
                    ->required()
                    ->placeholder('Location'),
                Forms\Components\TextInput::make('subscriptionFee')
                    ->label('Subscription Fee')
                    ->required()
                    ->placeholder('Subscription Fee'),
                Forms\Components\Toggle::make('isChildEvent')
                    ->label('Evento infantil')
                    ->inline(false)
                    ->default(false)
                    ->helperText('Ative para exibir tamanhos infantis e campo de responsável na inscrição.'),
                Forms\Components\FileUpload::make('image')
                    ->label('Imagem da Homepage')
                    ->image()
                    ->disk('public')
                    ->directory('events/homepage')
                    ->visibility('public')
                    ->imageEditor()
                    ->helperText('Imagem exibida no card do evento na homepage.')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Imagem')
                    ->disk('public')
                    ->square(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('participants_count')
                    ->label('Participants')
                    ->counts('participants')
                    ->sortable(),
                Tables\Columns\TextColumn::make('runnerDate')
                    ->label('Data da Corrida')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('startDate')
                    ->label('Start Date')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('endDate')
                    ->label('End Date')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->label('Location')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subscriptionFee')
                    ->label('Subscription Fee')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('isChildEvent')
                    ->label('Infantil')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            ParticipantsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'view' => Pages\ViewEvent::route('/{record}'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
