<?php

namespace Tests\Feature;

use DOMDocument;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FileTest extends TestCase
{
    use DatabaseMigrations;

    private $xml;

    public function setUp(): void
    {
        parent::setUp();
        $this->xml = new DOMDocument();
		$this->xml->encoding = 'utf-8';
		$this->xml->xmlVersion = '1.0';
		$this->xml->formatOutput = true;

        $root = $this->xml->createElement('people');
        
        //Person 1
		$person_node = $this->xml->createElement('person');
        $child_node_personid = $this->xml->createElement('personid', '1');
        $child_node_personname = $this->xml->createElement('personname', 'Name 1');
        $person_node->appendChild($child_node_personid);
        $person_node->appendChild($child_node_personname);
        $phones_node = $this->xml->createElement('phones');
        $child_node_phone1 = $this->xml->createElement('phone', '2345678');
        $child_node_phone2 = $this->xml->createElement('phone', '1234567');
        $phones_node->appendChild($child_node_phone1);
        $phones_node->appendChild($child_node_phone2);
        $person_node->appendChild($phones_node);


        //Person 2
        $person_node2 = $this->xml->createElement('person');
        $child_node_personid = $this->xml->createElement('personid', '2');
        $child_node_personname = $this->xml->createElement('personname', 'Name 2');
        $person_node2->appendChild($child_node_personid);
        $person_node2->appendChild($child_node_personname);
        $phones_node = $this->xml->createElement('phones');
        $child_node_phone1 = $this->xml->createElement('phone', '4444444');
        $phones_node->appendChild($child_node_phone1);
        $person_node2->appendChild($phones_node);



        $root->appendChild($person_node);
        $root->appendChild($person_node2);

		$this->xml->appendChild($root);

        $this->xml->save('test.xml');
    }
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        //I tried the test but it didn't work
        //UploadFormRequest is not validating
        $this->withoutMiddleware();

        $filePath='test.xml';

        $file = new UploadedFile($filePath, 'test.xml', 'text/xml', null, true);

        $this->postJson('/upload-person', [
            "file" => $file,
        ])->assertStatus(200);

    }
}
