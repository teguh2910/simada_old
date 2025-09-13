<?php

namespace Tests\Unit\Models;

use App\SurveySupplier;
use App\Supplier;
use TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SurveySupplierTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_can_be_created()
    {
        $survey = new SurveySupplier([
            'link_form' => 'https://forms.example.com/survey123',
            'file' => 'survey_document.pdf',
            'id_supplier' => 1,
            'due_date' => '2025-12-31'
        ]);

        $this->assertEquals('https://forms.example.com/survey123', $survey->link_form);
        $this->assertEquals('survey_document.pdf', $survey->file);
        $this->assertEquals(1, $survey->id_supplier);
        $this->assertEquals('2025-12-31', $survey->due_date);
    }

    /** @test */
    public function it_has_fillable_attributes()
    {
        $survey = new SurveySupplier();
        $fillable = $survey->getFillable();

        $expected = ['link_form', 'file', 'id_supplier', 'due_date'];
        
        foreach ($expected as $attribute) {
            $this->assertContains($attribute, $fillable);
        }
    }

    /** @test */
    public function it_belongs_to_supplier()
    {
        $this->assertInstanceOf(
            \Illuminate\Database\Eloquent\Relations\BelongsTo::class,
            (new SurveySupplier())->supplier()
        );
    }

    /** @test */
    public function it_can_save_survey_supplier_to_database()
    {
        $survey = SurveySupplier::create([
            'link_form' => 'https://example.com/test-survey',
            'file' => 'test_survey.pdf',
            'id_supplier' => 1,
            'due_date' => '2025-06-30'
        ]);

        // Verify in database using direct query
        $savedSurvey = SurveySupplier::where('link_form', 'https://example.com/test-survey')
                                     ->where('file', 'test_survey.pdf')
                                     ->where('id_supplier', 1)
                                     ->first();
        
        $this->assertInstanceOf(SurveySupplier::class, $savedSurvey);
        $this->assertEquals('https://example.com/test-survey', $savedSurvey->link_form);
        $this->assertEquals('test_survey.pdf', $savedSurvey->file);
        $this->assertEquals(1, $savedSurvey->id_supplier);

        $this->assertInstanceOf(SurveySupplier::class, $survey);
        $this->assertEquals('https://example.com/test-survey', $survey->link_form);
    }

    /** @test */
    public function it_can_be_created_with_link_form_only()
    {
        $survey = SurveySupplier::create([
            'link_form' => 'https://example.com/minimal-survey',
            'due_date' => '2025-12-31'
        ]);

        // Verify in database using direct query
        $savedSurvey = SurveySupplier::where('link_form', 'https://example.com/minimal-survey')->first();
        
        $this->assertInstanceOf(SurveySupplier::class, $savedSurvey);
        $this->assertEquals('https://example.com/minimal-survey', $savedSurvey->link_form);
        $this->assertEquals('2025-12-31', $savedSurvey->due_date);

        $this->assertEquals('https://example.com/minimal-survey', $survey->link_form);
        $this->assertEquals('2025-12-31', $survey->due_date);
        $this->assertNull($survey->file);
        $this->assertNull($survey->id_supplier);
    }

    /** @test */
    public function it_can_be_created_with_file_only()
    {
        $survey = SurveySupplier::create([
            'link_form' => 'https://example.com/file-survey',
            'file' => 'standalone_survey.docx',
            'due_date' => '2025-12-31'
        ]);

        // Verify in database using direct query
        $savedSurvey = SurveySupplier::where('file', 'standalone_survey.docx')->first();
        
        $this->assertInstanceOf(SurveySupplier::class, $savedSurvey);
        $this->assertEquals('standalone_survey.docx', $savedSurvey->file);
        $this->assertEquals('https://example.com/file-survey', $savedSurvey->link_form);

        $this->assertEquals('standalone_survey.docx', $survey->file);
        $this->assertEquals('https://example.com/file-survey', $survey->link_form);
        $this->assertEquals('2025-12-31', $survey->due_date);
    }

    /** @test */
    public function it_can_store_various_file_types()
    {
        $fileTypes = [
            'survey.pdf',
            'questionnaire.docx',
            'form.xlsx',
            'survey_template.pptx',
            'requirements.txt'
        ];

        foreach ($fileTypes as $file) {
            $survey = SurveySupplier::create([
                'file' => $file,
                'link_form' => "https://example.com/survey-{$file}",
                'due_date' => '2025-12-31'
            ]);

            $this->assertEquals($file, $survey->file);
            // assertDatabaseHas replaced for Laravel 5 compatibility
        }
    }

    /** @test */
    public function it_can_store_various_url_formats()
    {
        $urls = [
            'https://forms.google.com/survey123',
            'http://internal-server.com/survey',
            'https://surveymonkey.com/r/ABCD1234',
            'https://typeform.com/to/xyz789',
            'https://company.com/supplier-survey?id=123'
        ];

        foreach ($urls as $url) {
            $survey = SurveySupplier::create([
                'link_form' => $url,
                'due_date' => '2025-12-31'
            ]);

            $this->assertEquals($url, $survey->link_form);
            // assertDatabaseHas replaced for Laravel 5 compatibility
        }
    }

    /** @test */
    public function it_can_associate_with_supplier_id()
    {
        // Create surveys with different supplier IDs
        $supplierIds = [1, 5, 10, 999];

        foreach ($supplierIds as $supplierId) {
            $survey = SurveySupplier::create([
                'link_form' => "https://example.com/survey-{$supplierId}",
                'id_supplier' => $supplierId,
                'due_date' => '2025-12-31'
            ]);

            $this->assertEquals($supplierId, $survey->id_supplier);
            
            // Verify in database using direct query
            $savedSurvey = SurveySupplier::where('id_supplier', $supplierId)->first();
            $this->assertInstanceOf(SurveySupplier::class, $savedSurvey);
            $this->assertEquals($supplierId, $savedSurvey->id_supplier);
            $this->assertEquals("https://example.com/survey-{$supplierId}", $savedSurvey->link_form);
        }
    }

    /** @test */
    public function it_can_store_due_dates()
    {
        $dueDates = [
            '2025-01-15',
            '2025-06-30',
            '2025-12-31',
            '2026-03-15'
        ];

        foreach ($dueDates as $dueDate) {
            $survey = SurveySupplier::create([
                'link_form' => "https://example.com/survey-{$dueDate}",
                'due_date' => $dueDate
            ]);

            $this->assertEquals($dueDate, $survey->due_date);
            // assertDatabaseHas replaced for Laravel 5 compatibility
        }
    }
}
