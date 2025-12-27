<?php
namespace Softr\Asaas\Entity;

/**
 * Bank Slip Line Entity
 *
 * @author Agência Softr <agencia.softr@gmail.com>
 */
final class BankSlipLineEntity extends \Softr\Asaas\Entity\AbstractEntity
{
    /**
     * Identification Field
     * @var string
     */
    public $identificationField;

    /**
     * Nosso Número
     * @var string
     */
    public $nossoNumero;

    /**
     * Bar Code
     * @var string
     */
    public $barCode;

    /**
     * @param  string  $identificationField
     */
    public function setIdentificationField($identificationField)
    {
        $this->identificationField = $identificationField;
    }

    /**
     * @param  string  $nossoNumero
     */
    public function setNossoNumero($nossoNumero)
    {
        $this->nossoNumero = $nossoNumero;
    }

    /**
     * @param  string  $barCode
     */
    public function setBarCode($barCode)
    {
        $this->barCode = $barCode;
    }
}