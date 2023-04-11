<?php

namespace Tests\StringTruncator;

require_once 'Shared/Transfer/StringTruncatorTransfer.php';
require_once 'StringTruncator/StringTruncatorFacade.php';
require_once 'StringTruncator/StringTruncatorFacadeInterface.php';

use Shared\Transfer\StringTruncatorTransfer;
use StringTruncator\StringTruncatorFacade;
use StringTruncator\StringTruncatorFacadeInterface;

class StringTruncatorTest
{
    /**
     * @param \StringTruncator\StringTruncatorFacadeInterface $stringTruncatorFacade
     */
    public function __construct(
        protected StringTruncatorFacadeInterface $stringTruncatorFacade = new StringTruncatorFacade(),
    ) {
    }

    /**
     * @return void
     */
    public function testTruncateString(): void
    {
        $output = '';
        $receivedPoints = 0;
        $totalPoints = 0;

        foreach ($this->examples() as $topic => [$string, $limit, $expected, $points]) {
            $truncatedString = $this->truncate($string, $limit);
            $result = $truncatedString === $expected;

            $testResult = $result ? 'green' : 'red';

            if ($result) {
                $receivedPoints += $points;
            }

            $totalPoints += $points;

            $output .= "
                <tr bgcolor='#ffffff'>
                    <td><font color='$testResult'>$testResult</font></td>
                    <td>$string</td>
                    <td>$limit</td>
                    <td>$truncatedString</td>
                    <td>$expected</td>
                    <td>$points</td>
                </tr>
            ";
        }

        // Html output section
        echo"
            <html>
                <head>
                <title>Coding</title>
                <style type='text/css'>
                    body {
                        font-family: verdana, arial, sans-serif;
                    }
                </style>
                </head>
                <body>
                    Congratulations! <br>
                    You have achieved $receivedPoints points out of $totalPoints.
                    <br><br>
                    <table cellspacing='3' bgcolor='#000000'>
                        <tr bgcolor='#ffffff'>
                            <th>Test</th>
                            <th>String</th>
                            <th>Limit</th>
                            <th>Result</th>
                            <th>Expected</th>
                            <th>Points</th>
                        </tr>
                        $output
                    </table>
                </body>
            </html>
        ";
    }

    /**
     * @param string $string
     * @param int $limit
     *
     * @return string
     */
    protected function truncate(string $string, int $limit): string
    {
        $stringTruncatorTransfer = $this->createStringTruncatorTransfer($string, $limit);

        return $this->stringTruncatorFacade->truncateString($stringTruncatorTransfer);
    }

    /**
     * @param string $string
     * @param int $limit
     *
     * @return \Shared\Transfer\StringTruncatorTransfer
     */
    protected function createStringTruncatorTransfer(string $string, int $limit = 1000): StringTruncatorTransfer
    {
        $stringTruncatorTransfer = new StringTruncatorTransfer();
        $stringTruncatorTransfer->setString($string);
        $stringTruncatorTransfer->setLimit($limit);

        return $stringTruncatorTransfer;
    }

    /**
     * @return \Generator
     */
    protected function examples(): \Generator
    {
        yield 'trim text by dot' => ['text text. text.', 12, 'text text.', 5];
        yield 'trim with sentence separator at max length position' => ['first sentence. second sentence. text!', 32, 'first sentence. second sentence.', 10];
        yield 'small string' => ['text', 1000, 'text', 1];
        yield 'empty string' => ['', 1000, '', 1];
        yield 'trim text with length equals to max length' => ['text. text.', 11, 'text. text.', 2];
        yield 'small string with dots' => ['text. text! text.', 1000, 'text. text! text.', 2];
        yield 'trim with zero as max length' => ['text.text', 0, '', 1];
        yield 'max length less than text length' => ['text', 3, 'tex', 2];
        yield 'trim text without sentences' => ['text, text (text text);', 15, 'text, text (tex', 5];
        yield 'trim by ...' => ['first sentence. second sentence... other text.', 40, 'first sentence. second sentence...', 5];
        yield 'advanced: trim by question mark' => ['text. text? text', 15, 'text. text?', 10];
        yield 'trim with negative max length' => ['text text. abc', -2, '', 2];
        yield 'advanced: trim by exclamation mark' => ['text? text. text! text text. text.', 25, 'text? text. text!', 10];
        yield 'advanced: trim by question exclamation mark' => ['text. text?! text text text', 15, 'text. text?!', 10];
        yield 'advanced: trim by exclamation question mark' => ['text. text!? text text text', 15, 'text. text!?', 10];
        yield 'trim with multiple dots' => ['Bislang (Stand 9.1.) wurden in München insgesamt 2.573.163 Impfungen durchgeführt (1.058.319 Erst- und 1.003.629 Zweitimpfungen sowie 511.215 Drittimpfungen). Impfungen durch (1.2) Betriebsärzt*innen wurden bislang nicht erfasst. Die Münchner Impfquote liegt damit, bezogen auf die Gesamtbevölkerung, bei den Erstimpfungen bei 71,1 %, bei den Zweitimpfungen bei 67,4 % und bei den Drittimpfungen („Boosterimpfung“) bei 34,4 %.', 200, 'Bislang (Stand 9.1.) wurden in München insgesamt 2.573.163 Impfungen durchgeführt (1.058.319 Erst- und 1.003.629 Zweitimpfungen sowie 511.215 Drittimpfungen).', 12];
        yield 'trim multibyte text' => ['Für über 30-Jährige wird für Erst- und Auffrischungsimpfungen Moderna verwendet, ausgenommen sind Schwangere und Stillende. Für die Zweitimpfungen wird BioNTech verwendet, wenn der Impfzyklus damit begonnen wurde.', 150, 'Für über 30-Jährige wird für Erst- und Auffrischungsimpfungen Moderna verwendet, ausgenommen sind Schwangere und Stillende.', 12];
    }
}
