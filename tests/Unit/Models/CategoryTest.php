<?php

# Classe especifica               - vendor/bin/phpunit tests/Unit/CategoryTest.php
# Método especifico em um arquivo - vendor/bin/phpunit --filter testIfUseTraits tests/Unit/CategoryTest.php
# Método especifico em uma classe - vendor/bin/phpunit --filter CategoryTeste::testIfUseTraits

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    private $category;

    // run once at the beginning of all tests
    protected function setUp(): void
    {
        parent::setUp();
        $this->category = new Category();
    }

    // run once at the end of all tests
    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testFillableAttribute()
    {
        $fillable = ['name', 'description', 'is_active'];
        $this->assertEquals($fillable, $this->category->getFillable());
    }


    public function testIfUseTraitsAttribute()
    {
        $traits = [
            SoftDeletes::class, Uuid::class
        ];
        $categoryTraits = array_keys(class_uses(Category::class));
        $this->assertEquals($traits, $categoryTraits);
    }

    public function testDatesAttribute()
    {
        $dates = ['deleted_at', 'created_at', 'updated_at'];
        foreach ($dates as $date) {
            $this->assertContains($date, $this->category->getDates());
            $this->assertCount(count($dates), $this->category->getDates());
        }
    }

    public function testCastsAttribute()
    {
        $casts = ['id' => 'string', 'is_active' => 'boolean'];
        $this->assertEquals($casts, $this->category->getCasts());
    }

    public function testIncrementingAttribute()
    {
        $this->assertFalse($this->category->incrementing);
    }
}
