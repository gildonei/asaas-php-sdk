<?php
namespace Softr\Asaas\Entity;

/**
 * Pix Qr Code Entity
 *
 * @author Agência Softr <agencia.softr@gmail.com>
 */
final class PixQrCodeEntity extends \Softr\Asaas\Entity\AbstractEntity
{
    /**
     * Encoded Image
     * @var string
     */
    public $encodedImage;

    /**
     * QRcode Copy and Paste
     * @var string
     */
    public $payload;

    /**
     * QRCode Expiration Date
     * @var \DateTime
     */
    public $expirationDate;

    /**
     * QRCode Description
     * @var string
     */
    public $description;

    /**
     * @param  string  $encodedImage
     */
    public function setEncodedImage($encodedImage)
    {
        $this->encodedImage = $encodedImage;
    }

    /**
     * @param  string  $payload
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
    }

    /**
     * @param  string  $expirationDate
     */
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = static::convertDateTime($expirationDate);
    }

    /**
     * @param  string  $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}