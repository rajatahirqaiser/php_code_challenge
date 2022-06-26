<?php
require_once 'CommonConst.php';
class FinalResult {
    function results($filename) {
        try {
            if (!file_exists($filename)) {
                throw new Exception(CommonConst::EXCEPTION_MESSAGE['FILE_NOT_FOUND'] . ' ' . $filename);
            }
            $file = fopen($filename, "r");
            if (!$file) {
                throw new Exception(CommonConst::EXCEPTION_MESSAGE['FILE_READ_PERMISSION_DENIED'] . ' ' . $filename);
            }
            if (trim(file_get_contents($filename)) === '') {
                throw new Exception(CommonConst::EXCEPTION_MESSAGE['FILE_EMPTY'] . ' ' . $filename);
            }
            $records = [];
            $first_row_of_csv_file = fgetcsv($file);
            while (!feof($file)) {
                $data = fgetcsv($file);
                    if (count($data) === 16) {
                    $received = [
                        "bank_code" => $data[0],
                        "amount" => [
                            "currency" => $first_row_of_csv_file[0],
                            "subunits" => (int) ((!$data[8] || $data[8] == "0" ? 0 : (float) $data[8]) * 100)
                        ],
                        "bank_account_name" => str_replace(" ", "_", strtolower($data[7])),
                        "bank_branch_code" => !$data[2] ? CommonConst::ERROR_MESSAGE['BANK_BRANCH_CODE_MISSING'] : $data[2],
                        "bank_account_number" => !$data[6] ? CommonConst::ERROR_MESSAGE['BANK_ACCOUNT_NUMBER_MISSING'] : (int) $data[6],
                        "end_to_end_id" => !$data[10] && !$data[11] ? CommonConst::ERROR_MESSAGE['END_TO_END_ID_MISSING'] : $data[10] . $data[11],
                    ];
                    $records[] = $received;
                }
            }
            $records = array_filter($records);
            fclose($file);
            return [
                "document" => $file,
                "filename" => basename($filename),
                "failure_code" => $first_row_of_csv_file[1],
                "failure_message" => $first_row_of_csv_file[2],
                "records" => $records
            ];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
