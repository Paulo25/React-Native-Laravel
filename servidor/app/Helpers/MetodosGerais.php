<?php
/**
 * Retains all general utility functions used in the system
 *
 * @author Paulo Vitor <paulo.vitor.programmer@gmail.com>
 */

if (!function_exists('checkPerfilRole')) {

    /**
     * Verififcar se a ação é permitida
     *
     * @param $role
     * @param array $permissions
     * @return bool
     */
    function checkPerfilRole($role, $permissions = [])
    {
        $allowed = false;

        if ($role && !empty($permissions)) {
            $allowed = in_array($role, $permissions);
        }

        return $allowed;
    }
}

if (!function_exists('checkId')) {

    /**
     * Verifica se o ID está vazio e se é um número inteiro
     *
     * @param $id
     * @return bool
     */
    function checkId($id)
    {

        if (empty($id) || !is_numeric($id) || is_float($id)) {
            return false;
        }

        return true;
    }
}

if (!function_exists('dateBR2US')) {
    /**
     * Converte data para o formato Y-m-d
     *
     * @param string $date
     * @param boolean $time
     *
     * @return string
     */
    function dateBR2US($date, $time = false)
    {
        if (!$date) return null;

        $date = str_replace('/', '-', $date);

        if ($time) {
            return date('Y-m-d H:i:s', strtotime($date));
        } else {
            return date('Y-m-d', strtotime($date));
        }
    }
}

if (!function_exists('dateUS2BR')) {
    /**
     * Converte data para o formato d/m/Y
     *
     * @param string $date
     * @param boolean $time
     *
     * @return string
     */
    function dateUS2BR($date, $time = false)
    {
        if (!$date) return null;

        if ($time) {
            return date('d/m/Y H:i', strtotime($date));
        } else {
            return date('d/m/Y', strtotime($date));
        }
    }
}

if (!function_exists('formatTime')) {
    /**
     * Converte hora para o formato
     *
     * @param $hour
     * @param string $format
     * @return false|string
     */
    function formatTime($hour, $format = 'H:i:s')
    {
        return date($format, strtotime($hour));
    }
}

if (!function_exists('isCpf')) {
    /**
     * Verifica se o valor informado é um CPF
     *
     * @param string $cpf
     *
     * @return bool
     */
    function isCpf($cpf)
    {
        return preg_match('/[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}/', $cpf);
    }
}

if (!function_exists('removeSpecialChars')) {
    /**
     * Remove caracteres especiais da string informada
     *
     * @param string $value
     *
     * @return string
     */
    function removeSpecialChars($value)
    {
        return preg_replace('/[^A-Za-z0-9\-]/', '', $value);
    }
}

if (!function_exists('replaceSpecialChars')) {
    /**
     * Subisttui caracteres especiais da string informada
     *
     * @param $value
     * @param string $replacement
     * @return string|string[]|null
     */
    function replaceSpecialChars($value, $replacement = ' ')
    {
        return preg_replace('/[^A-Za-z0-9\-]/', ' ', $value);
    }
}

if (!function_exists('getMonths')) {
    /**
     * Return all months from year
     *
     * @return array
     */
    function getMonths()
    {
        $meses = array(
            "01" => 'Janeiro',
            "02" => 'Fevereiro',
            "03" => 'Março',
            "04" => 'Abril',
            "05" => 'Maio',
            "06" => 'Junho',
            "07" => 'Julho',
            "08" => 'Agosto',
            "09" => 'Setembro',
            "10" => 'Outubro',
            "11" => 'Novembro',
            "12" => 'Dezembro'
        );

        return $meses;
    }
}

if (!function_exists('getYear')) {
    /**
     * Return array with all months from year
     *
     * @param null $initial
     * @param null $final
     * @return array
     */
    function getYear($initial = null, $final = null)
    {
        $i = $initial ?: \Carbon\Carbon::now()->year;;
        $end = $final ?: \Carbon\Carbon::now()->addYear(10)->year;
        $years = [];

        for ($i; $i <= $end; $i++) {
            $years[$i] = $i;
        }

        return $years;
    }
}

if (!function_exists('getParcels')) {
    /**
     * Return list parcels from the total value of cart
     *
     * @param float $totalValue
     * @param float $minInstallmentValue
     * @param int $maxParcelsCard
     * @return array
     */
    function getParcels(float $totalValue = 0, float $minInstallmentValue = 29.9, int $maxParcelsCard = 10)
    {
        $parcels = [];

        $maxParcels = (($maxParcels = $totalValue / $minInstallmentValue) < $maxParcelsCard) ? ($maxParcels < 1 ? 1 : $maxParcels) : $maxParcelsCard;
        $maxParcels = intval($maxParcels);

        for ($i = 1; $i <= $maxParcels; $i++) {
            $valueParcel = $totalValue / $i;
            $valueParcel = round($valueParcel, 2);
            $valueParcel = number_format($valueParcel, 2, ',', '.');
            $parcels[$i] = "{$i} x R$ {$valueParcel}";
        }

        return $parcels;
    }
}

if (!function_exists('validateCpf')) {
    /**
     * Returns validation to the CPF
     *
     * @param String $cpf
     * @return bool
     */
    function validateCpf(String $cpf)
    {
        $cpf = preg_replace("/[^0-9]/", '', $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        if (strlen($cpf) != 11) {
            return false;
        } elseif ($cpf == '00000000000' || $cpf == '11111111111' ||
            $cpf == '22222222222' || $cpf == '33333333333' ||
            $cpf == '44444444444' || $cpf == '55555555555' ||
            $cpf == '66666666666' || $cpf == '77777777777' ||
            $cpf == '88888888888' || $cpf == '99999999999') {
            return false;
        } else {
            for ($i = 0; $i < 2; $i++) {
                $result = 0;
                $checkUntil = 9 + $i;
                for ($c = 0, $multiplier = $checkUntil + 1; $c < $checkUntil; $c++, $multiplier--) {
                    $result += $cpf[$c] * $multiplier;
                }
                $result *= 10;
                $verifyingDigit = $result % 11;
                if ($verifyingDigit == 10) {
                    $verifyingDigit = 0;
                }
                if ($verifyingDigit != $cpf[$checkUntil]) {
                    return false;
                }
            }
            return true;
        }
    }
}

if (!function_exists('formatCPF')) {

    /**
     * Função para formatar CPF
     *
     * @param $cpf
     * @return bool|string|string[]|null
     */
    function formatCPF($cpf)
    {
        $cpfFormated = false;
        if (strlen(preg_replace("/\D/", '', $cpf)) === 11) {
            $cpfFormated = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cpf);
        }

        return $cpfFormated;
    }
}

if (!function_exists('removeSpacesBetweenWords')) {

    /**
     * Função para remover espaços a mais entre as palavras
     *
     * @param $string
     * @return string|string[]|null
     */
    function removeSpacesBetweenWords($string)
    {
        return preg_replace('/\s+/', ' ', $string);
    }
}

