<?php 
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require_once "src/FinalResult.php";

final class FinalResultTest extends TestCase {
    private $expected_return = [
        "filename"=>CommonConst::SAMPLE_FILE_NAME,
        "failure_code"=>CommonConst::FAILURE_CODE,
        "failure_message"=>CommonConst::FAILURE_MESSAGE,
        "records" => CommonConst::EXPECTED_RECORDS
    ];

    public function testReturnsTheCorrectHash(): void {
        $final_result = new FinalResult();
        $rtn = $final_result->results(CommonConst::SAMPLE_CSV_FILE_PATH);
        unset($rtn["document"]);
        $this->assertEquals($rtn, $this->expected_return);
    }
}
