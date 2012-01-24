<?php

class CheckoutData {
    
    public $shippingPlaceType;
    public $shippingCity;
    public $shippingTime;
    public $shippingDateDay;
    public $shippingDateMonth;
    public $shippingDateYear;
    public $exactIntervalFromHours;
    public $exactIntervalFromMinutes;
    public $exactIntervalTillHours;
    public $exactIntervalTillMinutes;
    public $paymentMethod;
    
    public function __construct() {
        
        $this->shippingPlaceType = array(
            1 => Yii::t('app', 'dzīvoklis'),
            2 => Yii::t('app', 'privātmāja'),
            3 => Yii::t('app', 'darba adrese'),
            4 => Yii::t('app', 'viesnīca'),
            5 => Yii::t('app', 'slimnīca'),
            6 => Yii::t('app', 'cits'),
        );
        
        $this->shippingCity = array(
            1 => Yii::t('app', 'Rīga'),
            2 => Yii::t('app', 'Rīga-Vecmīlgrāvis un tālāk'),
            3 => Yii::t('app', 'Rīga-Bolderāja un tālāk'),
            4 => Yii::t('app', 'Jūrmala no Lielupes līdz Majoriem'),
            5 => Yii::t('app', 'Jūrmala no Dubultiem līdz Ķemeriem'),
            6 => Yii::t('app', 'Rīgas rajons līdz apvidus ceļam'),
            7 => Yii::t('app', 'Rīgas rajons aiz apvidus ceļa'),
            8 => Yii::t('app', 'Latvija'),
        );
        
        $this->shippingTime = array(
            1 => '00:00 - 08:00',
            2 => '08:00 - 14:00',
            3 => '14:00 - 18:00',
            4 => '18:00 - 24:00',
            5 => Yii::t('app', 'Precīzs laika diapazons (+7Ls)'),
        );
        
        $this->shippingDateDay = $this->createArray(1, 31);
        
        $this->shippingDateMonth = array(
            1 => Yii::t('app', 'janvārī'),
            2 => Yii::t('app', 'februārī'),
            3 => Yii::t('app', 'martā'),
            4 => Yii::t('app', 'aprīlī'),
            5 => Yii::t('app', 'maijā'),
            6 => Yii::t('app', 'jūnijā'),
            7 => Yii::t('app', 'jūlijā'),
            8 => Yii::t('app', 'augustā'),
            9 => Yii::t('app', 'septembrī'),
            10 => Yii::t('app', 'oktobrī'),
            11 => Yii::t('app', 'novembrī'),
            12 => Yii::t('app', 'decembrī'),
        );
        
        $this->shippingDateYear = array(
            '2012' => '2012',
            '2013' => '2013',
        );
        
        $this->exactIntervalFromHours = $this->createArray(7, 23, 2, '0', 1, true);
        
        $this->exactIntervalFromMinutes = $this->createArray(0, 45, 2, '0', 15, true);
        
        $this->exactIntervalTillHours = $this->createArray(8, 24, 2, '0', 1, true);
        
        $this->exactIntervalTillMinutes = $this->createArray(0, 45, 2, '0', 15, true);
 
        $this->paymentMethod = array(
            1 => Yii::t('app', 'Salonā skaidrā naudā, VISA, EuroCard/MasterCard'),
            2 => Yii::t('app', 'Skaidrā naudā kurjeram (tikai Rīgā)'),
            3 => Yii::t('app', 'Ar pārskaitījumu uz mūsu bankas kontu'),
            4 => Yii::t('app', 'Ar kredītkarti caur PayPal'),
            5 => Yii::t('app', 'Western Union, UNISTREAM'),
        );

    }
    
    public function createArray($start, $end, $pad = 0, $padSymbol = '0', $interval = 1, $valueAsKey = false) {
        $array = array();
        $c = 0;
        $int = 0;
        if ($interval > 1) {
            $array[$start] = ($pad != 0) ? str_pad($start, $pad, $padSymbol, STR_PAD_LEFT) : $start;
        }
        for ($i = ($start); $i <= $end; $i++) {
            $int++;
            if ($int == $interval) {
                $c++;
                $key = $c;
                $value = $i;
                if ($interval > 1) {
                    $value = $i + 1;
                }
                if ($valueAsKey) {
                    $key = $value;
                }
                $array[$key] = ($pad != 0) ? str_pad($value, $pad, $padSymbol, STR_PAD_LEFT) : $value;
                $int = 0;
            }
        }
        return $array;
    }
    
}