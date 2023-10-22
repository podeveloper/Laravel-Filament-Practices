<?php

namespace App\Filament\Resources\VoucherResource\Pages;

use App\Filament\Resources\VoucherResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditVoucher extends EditRecord
{
    protected static string $resource = VoucherResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function beforeFill()
    {
        if ($this->record->payments()->exists()) {

            Notification::make()
                ->title('You can not edit the voucher after it has been used')
                ->danger()
                ->send();

            $this->redirect($this->getResource()::getUrl('index'));
        }
    }
}
