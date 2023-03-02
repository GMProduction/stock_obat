<?php


namespace App\Repository;


use App\Models\MedicineOut;
use App\Models\MedicineStock;
use App\Models\TransactionOut;

class TransactionOutRepository
{
    private $medicineRepository;
    private $medicineInRepository;
    private $medicineOutRepository;
    private $generalLedgerRepository;
    private $locationStockRepository;

    public function __construct(MedicineOutRepository $medicineOutRepository, MedicineRepository $medicineRepository, MedicineInRepository $medicineInRepository, GeneralLedgerRepository $generalLedgerRepository, LocationStockRepository $locationStockRepository)
    {
        $this->medicineOutRepository = $medicineOutRepository;
        $this->medicineRepository = $medicineRepository;
        $this->medicineInRepository = $medicineInRepository;
        $this->generalLedgerRepository = $generalLedgerRepository;
        $this->locationStockRepository = $locationStockRepository;
    }

    public function create($data)
    {
        return TransactionOut::create($data);
    }

    public function getData($preload = [])
    {
        return TransactionOut::with($preload)
            ->orderBy('date', 'DESC')
            ->get();
    }

    public function getTransactionOutById($id, $preload = [])
    {
        return TransactionOut::with($preload)->find($id)->append('total');
    }

    public function findMedicineByID($medicine_id, $preload = [])
    {
        return $this->medicineRepository->findById($medicine_id);
    }

    public function getAvailableStock($medicine_id, $preload = [])
    {
        return $this->medicineInRepository->getAvailableStock($medicine_id, $preload);
    }

    public function addToCart($data)
    {
        return $this->medicineOutRepository->create($data);
    }

    public function deleteCartItem($id)
    {
        return $this->medicineOutRepository->deleteByID($id);
    }

    public function cart($preload = [])
    {
        return $this->medicineOutRepository->cart($preload);
    }

    public function setTransactionIdToCart($id)
    {
        return $this->medicineOutRepository->setTransactionIdToCart($id);
    }

    public function saveToGeneralLedger($data)
    {
        return $this->generalLedgerRepository->create($data);
    }

    public function updateUsedStock($id, $qty = 0)
    {
        return $this->medicineInRepository->updateUsedStock($id, $qty);
    }

    public function reduceStock($medicine_id, $minusStock)
    {
        return $this->medicineRepository->reduceStock($medicine_id, $minusStock);
    }

    public function addOrUpdateToLocationStock($locationID, $medicineID, $qty = 0)
    {
        return $this->locationStockRepository->addOrUpdateToLocationStock($locationID, $medicineID, $qty);
    }

    public function getStockByLocationIDAndMedicineID($locationID, $medicineID)
    {
        return $this->locationStockRepository->getStockByLocationIDAndMedicineID($locationID, $medicineID);
    }

    public function getMedicineStocks($medicine_id, $preload = [])
    {
        return MedicineStock::with($preload)
            ->where('medicine_id', '=', $medicine_id)
            ->where('qty', '>', 0)
            ->orderBy('expired_date', 'ASC')
            ->get();
    }

    public function restoreMedicineStockFromCart($id)
    {
        $cart = MedicineOut::find($id);
        $expired_date = $cart->expired_date;
        $medicine_id = $cart->medicine_id;
        $restoredQty = $cart->qty;
        $medicine_stock = MedicineStock::where('medicine_id', '=', $medicine_id)
            ->where('expired_date', '=', $expired_date)
            ->first();
        if ($medicine_stock) {
            $currentQty = $medicine_stock->qty;
            $newQty = $currentQty + $restoredQty;
            return $medicine_stock->update([
                'qty' => $newQty
            ]);
        }
        return MedicineStock::create([
            'medicine_id' => $medicine_id,
            'expired_date' => $expired_date,
            'qty' => $restoredQty
        ]);
    }

    public function cleanZeroStock()
    {
        return MedicineStock::with([])
            ->where('qty', '<=', 0)
            ->delete();
    }
}
