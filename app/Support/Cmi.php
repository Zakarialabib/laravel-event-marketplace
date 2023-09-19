<?php

declare(strict_types=1);

namespace App\Support;

use App\Exceptions\InvalidConfiguration;
use App\Exceptions\InvalidRequest;

class Cmi
{
    private readonly string $baseUri;

    private readonly string $clientId;

    private readonly string $storeKey;

    private readonly string $storeType;

    private readonly string $tranType;

    private string $lang;

    private string $currency;

    private string $okUrl;

    private string $failUrl;

    private string $shopUrl;

    private string $callbackUrl;

    private readonly string $hashAlgorithm;

    private readonly string $encoding;

    private string $sessionTimeout;

    private string $amount;

    private string $oid;

    private string $email;

    private string $billToName;

    private string $tel;

    private string $amountCur;

    private string $symbolCur;

    private string $description;

    public function __construct()
    {
        $this->baseUri = config('cmi-payment.baseUri');
        $this->clientId = config('cmi-payment.clientId');
        $this->storeKey = config('cmi-payment.storeKey');
        $this->storeType = config('cmi-payment.storeType');
        $this->tranType = config('cmi-payment.tranType');
        $this->lang = config('cmi-payment.lang');
        $this->currency = config('cmi-payment.currency');
        $this->okUrl = config('cmi-payment.okUrl');
        $this->failUrl = config('cmi-payment.failUrl');
        $this->shopUrl = config('cmi-payment.shopUrl');
        $this->callbackUrl = config('cmi-payment.callbackUrl');
        $this->hashAlgorithm = config('cmi-payment.hashAlgorithm');
        $this->encoding = config('cmi-payment.encoding');
        $this->sessionTimeout = config('cmi-payment.sessionTimeout');
        $this->guardAgainstInvalidConfiguration();
    }

    public function getBaseUri(): null|string
    {
        return $this->baseUri;
    }

    public function getFailUrl(): null|string
    {
        return $this->failUrl;
    }

    public function getShopUrl(): null|string
    {
        return $this->shopUrl;
    }

    public function enableAutoRedirect(): void
    {
    }

    public function disableAutoRedirect(): void
    {
    }

    public function enableCallbackRespense(): void
    {
    }

    public function disableCallbackRespense(): void
    {
    }

    public function setOkUrl(string $okUrl): void
    {
        $this->okUrl = $okUrl;
    }

    public function setFailUrl(string $failUrl): void
    {
        $this->failUrl = $failUrl;
    }

    public function setShopUrl(string $shopUrl): void
    {
        $this->shopUrl = $shopUrl;
    }

    public function setCallbackUrl(string $callbackUrl): void
    {
        $this->callbackUrl = $callbackUrl;
    }

    public function setSessionTimeout($seconds): void
    {
        $this->sessionTimeout = (string) $seconds;
    }

    public function setOid($oid): void
    {
        $this->oid = (string) $oid;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setAmount($amount): void
    {
        $this->amount = (string) $amount;
    }

    public function setBillToName(string $billToName): void
    {
        $this->billToName = $billToName;
    }

    public function setTel(string $tel): void
    {
        $this->tel = $tel;
    }

    public function setLang(string $lang): void
    {
        $this->lang = $lang;
    }

    public function setCurrency($currency): void
    {
        $this->currency = (string) $currency;
    }

    public function enableCurrenciesList(): void
    {
    }

    public function setAmountCur($amountCur): void
    {
        $this->amountCur = (string) $amountCur;
    }

    public function setSymbolCur($symbolCur): void
    {
        $this->symbolCur = (string) $symbolCur;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getHash(array $params = []): string
    {
        $cmiData = $this->getCmiData($params);
        $plainText = $this->getPlainText($cmiData);

        return base64_encode(pack('H*', hash('sha512', $plainText)));
    }

    public function getCmiData(array $params = []): array
    {
        $cmiParams = array_merge(get_object_vars($this), $params);
        $this->unsetData($cmiParams);

        return $cmiParams;
    }

    private function getPlainText(&$data): string
    {
        $plainText = '';
        ksort($data);

        foreach ($data as $key => $value) {
            $formattedValue = trim((string) $value);
            $formattedValue = str_replace('|', '\\|', str_replace('\\', '\\\\', $formattedValue));

            if (strtolower((string) $key) != 'hash' && strtolower((string) $key) != 'encoding') {
                $plainText = $plainText.$formattedValue.'|';
            }
        }

        $escapedStoreKey = str_replace('|', '\\|', str_replace('\\', '\\\\', $this->storeKey));

        return $plainText.$escapedStoreKey;
    }

    private function unsetData(array &$data): void
    {
        unset($data['storeKey'], $data['baseUri']);
    }

    public function validateHash(array $data, $actualHash): bool
    {
        $this->unsetData($data);
        $postParams = [];

        foreach ($data as $key => $value) {
            $postParams[] = $key;
        }

        natcasesort($postParams);

        $hashval = '';

        foreach ($postParams as $param) {
            $paramValue = trim(html_entity_decode(preg_replace("/\n$/", '', (string) $data[$param]), ENT_QUOTES, 'UTF-8'));
            $escapedParamValue = str_replace('|', '\\|', str_replace('\\', '\\\\', $paramValue));
            $escapedParamValue = preg_replace('/document(.)/i', 'document.', $escapedParamValue);

            $lowerParam = strtolower((string) $param);

            if ($lowerParam != 'hash' && $lowerParam != 'encoding') {
                $hashval = $hashval.$escapedParamValue.'|';
            }
        }

        $escapedStoreKey = str_replace('|', '\\|', str_replace('\\', '\\\\', $this->storeKey));
        $hashval .= $escapedStoreKey;

        $calculatedHashValue = hash('sha512', $hashval);
        $hash = base64_encode(pack('H*', $calculatedHashValue));

        return $actualHash === $hash;
    }

    /** @throws InvalidRequest */
    public function guardAgainstInvalidRequest(): void
    {
        //amount
        if ($this->amount == null) {
            throw InvalidRequest::amountNotSpecified();
        }

        if ( ! preg_match('/^\d+(\.\d{2})?$/', $this->amount)) {
            throw InvalidRequest::amountValueInvalid();
        }

        //currency
        if ($this->currency == null) {
            throw InvalidRequest::currencyNotSpecified();
        }

        if ( ! is_string($this->currency) || strlen($this->currency) != 3) {
            throw InvalidRequest::currencyValueInvalid();
        }

        //oid
        if ($this->oid == null) {
            throw InvalidRequest::attributeNotSpecified('identifiant de la commande (oid)');
        }

        if ( ! is_string($this->oid) || preg_match('/\s/', $this->oid)) {
            throw InvalidRequest::attributeInvalidString('identifiant de la commande (oid)');
        }

        //email
        if ($this->email == null) {
            throw InvalidRequest::attributeNotSpecified('adresse électronique du client (email)');
        }

        if ( ! filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw InvalidRequest::emailValueInvalid();
        }

        //billToName
        if ($this->billToName === null) {
            throw InvalidRequest::attributeNotSpecified('nom du client (billToName)');
        }

        if ( ! is_string($this->billToName) || $this->billToName == '') {
            throw InvalidRequest::attributeInvalidString('nom du client (billToName)');
        }

        //tel
        if (isset($this->tel) && ! is_string($this->tel)) {
            throw InvalidRequest::attributeInvalidString('téléphone du client (tel)');
        }

        //amountCur
        if (isset($this->amountCur) && ! is_string($this->amountCur)) {
            throw InvalidRequest::attributeInvalidString('montant de coversion (amountCur)');
        }

        //symbolCur
        if (isset($this->symbolCur) && ! is_string($this->symbolCur)) {
            throw InvalidRequest::attributeInvalidString('symbole de la devise de conversion (symbolCur)');
        }

        //description
        if (isset($this->description) && ! is_string($this->description)) {
            throw InvalidRequest::attributeInvalidString('description');
        }
    }

    /** @throws InvalidConfiguration */
    private function guardAgainstInvalidConfiguration(): void
    {
        //clientId
        if ($this->clientId === '' || $this->clientId === '0') {
            throw InvalidConfiguration::clientIdNotSpecified();
        }

        if (preg_match('/\s/', $this->clientId)) {
            throw InvalidConfiguration::clientIdInvalid();
        }

        //storeKey
        if ($this->storeKey === '' || $this->storeKey === '0') {
            throw InvalidConfiguration::storeKeyNotSpecified();
        }

        if (preg_match('/\s/', $this->storeKey)) {
            throw InvalidConfiguration::storeKeyInvalid();
        }

        //storeType
        if ($this->storeType === '' || $this->storeType === '0') {
            throw InvalidConfiguration::attributeNotSpecified('modèle du paiement du marchand (storeType)');
        }

        if (preg_match('/\s/', $this->storeType)) {
            throw InvalidConfiguration::attributeInvalidString('modèle du paiement du marchand (storeType)');
        }

        //tranType
        if ($this->tranType === '' || $this->tranType === '0') {
            throw InvalidConfiguration::attributeNotSpecified('Type de la transaction (tranType)');
        }

        if (preg_match('/\s/', $this->tranType)) {
            throw InvalidConfiguration::attributeInvalidString('Type de la transaction (tranType)');
        }

        //lang
        if ( ! in_array($this->lang, ['fr', 'ar', 'en'])) {
            throw InvalidConfiguration::langValueInvalid();
        }

        //baseUri
        if ($this->baseUri === '' || $this->baseUri === '0') {
            throw InvalidConfiguration::attributeNotSpecified('gateway de paiement (baseUri)');
        }

        if (preg_match('/\s/', $this->baseUri)) {
            throw InvalidConfiguration::attributeInvalidString('gateway de paiement (baseUri)');
        }

        if ( ! preg_match("/\b(?:(?:https):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $this->baseUri)) {
            throw InvalidConfiguration::attributeInvalidUrl('gateway de paiement (baseUri)');
        }

        //okUrl
        if ($this->okUrl === '' || $this->okUrl === '0') {
            throw InvalidConfiguration::attributeNotSpecified('okUrl');
        }

        if (preg_match('/\s/', $this->okUrl)) {
            throw InvalidConfiguration::attributeInvalidString('okUrl');
        }

        if ( ! preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $this->okUrl)) {
            throw InvalidConfiguration::attributeInvalidUrl('okUrl');
        }

        //failUrl
        if ($this->failUrl === '' || $this->failUrl === '0') {
            throw InvalidConfiguration::attributeNotSpecified('failUrl');
        }

        if (preg_match('/\s/', $this->failUrl)) {
            throw InvalidConfiguration::attributeInvalidString('failUrl');
        }

        if ( ! preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $this->failUrl)) {
            throw InvalidConfiguration::attributeInvalidUrl('failUrl');
        }

        //shopUrl
        if ($this->shopUrl === '' || $this->shopUrl === '0') {
            throw InvalidConfiguration::attributeNotSpecified('shopUrl');
        }

        if (preg_match('/\s/', $this->failUrl)) {
            throw InvalidConfiguration::attributeInvalidString('shopUrl');
        }

        if ( ! preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $this->shopUrl)) {
            throw InvalidConfiguration::attributeInvalidUrl('shopUrl');
        }

        //callbackUrl
        if ($this->callbackUrl === '' || $this->callbackUrl === '0') {
            throw InvalidConfiguration::attributeNotSpecified('callbackUrl');
        }

        if (preg_match('/\s/', $this->callbackUrl)) {
            throw InvalidConfiguration::attributeInvalidString('callbackUrl');
        }

        if ( ! preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $this->callbackUrl)) {
            throw InvalidConfiguration::attributeInvalidUrl('callbackUrl');
        }

        //hashAlgorithm
        if ($this->hashAlgorithm === '' || $this->hashAlgorithm === '0') {
            throw InvalidConfiguration::attributeNotSpecified('version du hachage (hashAlgorithm)');
        }

        if (preg_match('/\s/', $this->hashAlgorithm)) {
            throw InvalidConfiguration::attributeInvalidString('version du hachage (hashAlgorithm)');
        }

        //encoding
        if ($this->encoding === '' || $this->encoding === '0') {
            throw InvalidConfiguration::attributeNotSpecified('encodage des données (encoding)');
        }

        if (preg_match('/\s/', $this->encoding)) {
            throw InvalidConfiguration::attributeInvalidString('encodage des données (encoding)');
        }

        //sessionTimeout
        if ($this->sessionTimeout === '' || $this->sessionTimeout === '0') {
            throw InvalidConfiguration::attributeNotSpecified('délai d\'expiration de la session (sessionTimeout)');
        }

        if ((int) $this->sessionTimeout < 30 || (int) $this->sessionTimeout > 2700) {
            throw InvalidConfiguration::sessionimeoutValueInvalid();
        }
    }
}
