<?php

namespace MStaack\LaravelPostgis\Tests\Schema\Grammars;

use Illuminate\Database\Connection;
use Mockery;
use MStaack\LaravelPostgis\Exceptions\UnsupportedGeomtypeException;
use MStaack\LaravelPostgis\PostgisConnection;
use MStaack\LaravelPostgis\Schema\Blueprint;
use MStaack\LaravelPostgis\Schema\Grammars\PostgisGrammar;
use MStaack\LaravelPostgis\Tests\BaseTestCase;

class PostgisGrammarTest extends BaseTestCase
{
    public function testAddingPoint()
    {
        $blueprint = new Blueprint('test');
        $blueprint->point('foo');
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());

        $this->assertCount(1, $statements);
        $this->assertStringContainsString('GEOGRAPHY(POINT, 4326)', $statements[0]);
    }

    public function testAddingPointGeom()
    {
        $blueprint = new Blueprint('test');
        $blueprint->point('foo', 'GEOMETRY', 27700);
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());
        $this->assertCount(1, $statements);
        $this->assertStringContainsString('GEOMETRY(POINT, 27700)', $statements[0]);
    }

    public function testAddingPointWrongSrid()
    {
        $this->expectException(UnsupportedGeomtypeException::class);
        $blueprint = new Blueprint('test');
        $blueprint->point('foo', 'GEOGRAPHY', 27700);
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());
        $this->assertCount(1, $statements);;
    }

    public function testAddingPointUnsupported()
    {
        $this->expectException(UnsupportedGeomtypeException::class);
        $blueprint = new Blueprint('test');
        $blueprint->point('foo', 'UNSUPPORTED_ENTRY', 27700);
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());
        $this->assertCount(1, $statements);;
    }

    public function testAddingLinestring()
    {
        $blueprint = new Blueprint('test');
        $blueprint->linestring('foo');
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());

        $this->assertCount(1, $statements);;
        $this->assertStringContainsString('GEOGRAPHY(LINESTRING, 4326)', $statements[0]);
    }

    public function testAddingLinestringGeom()
    {
        $blueprint = new Blueprint('test');
        $blueprint->linestring('foo', 'GEOMETRY', 27700);
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());
        $this->assertCount(1, $statements);;
        $this->assertStringContainsString('GEOMETRY(LINESTRING, 27700)', $statements[0]);
    }

    public function testAddingLinestringWrongSrid()
    {
        $this->expectException(UnsupportedGeomtypeException::class);
        $blueprint = new Blueprint('test');
        $blueprint->linestring('foo', 'GEOGRAPHY', 27700);
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());
        $this->assertCount(1, $statements);;
    }

    public function testAddingLinestringUnsupported()
    {
        $this->expectException(UnsupportedGeomtypeException::class);
        $blueprint = new Blueprint('test');
        $blueprint->linestring('foo', 'UNSUPPORTED_ENTRY', 27700);
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());
        $this->assertCount(1, $statements);
    }

    public function testAddingPolygon()
    {
        $blueprint = new Blueprint('test');
        $blueprint->polygon('foo');
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());

        $this->assertCount(1, $statements);
        $this->assertStringContainsString('GEOGRAPHY(POLYGON, 4326)', $statements[0]);
    }

    public function testAddingPolygonGeom()
    {
        $blueprint = new Blueprint('test');
        $blueprint->polygon('foo', 'GEOMETRY', 27700);
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());
        $this->assertCount(1, $statements);
        $this->assertStringContainsString('GEOMETRY(POLYGON, 27700)', $statements[0]);
    }

    public function testAddingPolygonWrongSrid()
    {
        $this->expectException(UnsupportedGeomtypeException::class);
        $blueprint = new Blueprint('test');
        $blueprint->polygon('foo', 'GEOGRAPHY', 27700);
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());
        $this->assertCount(1, $statements);
    }

    public function testAddingPolygonUnsupported()
    {
        $this->expectException(UnsupportedGeomtypeException::class);
        $blueprint = new Blueprint('test');
        $blueprint->polygon('foo', 'UNSUPPORTED_ENTRY', 27700);
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());
        $this->assertCount(1, $statements);
    }

    public function testAddingMultipoint()
    {
        $blueprint = new Blueprint('test');
        $blueprint->multipoint('foo');
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());

        $this->assertCount(1, $statements);
        $this->assertStringContainsString('GEOGRAPHY(MULTIPOINT, 4326)', $statements[0]);
    }

    public function testAddingMultipointGeom()
    {
        $blueprint = new Blueprint('test');
        $blueprint->multipoint('foo', 'GEOMETRY', 27700);
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());
        $this->assertCount(1, $statements);
        $this->assertStringContainsString('GEOMETRY(MULTIPOINT, 27700)', $statements[0]);
    }

    public function testAddingMultiPointWrongSrid()
    {
        $this->expectException(UnsupportedGeomtypeException::class);
        $blueprint = new Blueprint('test');
        $blueprint->multipoint('foo', 'GEOGRAPHY', 27700);
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());
        $this->assertCount(1, $statements);
    }

    public function testAddingMultiPointUnsupported()
    {
        $this->expectException(UnsupportedGeomtypeException::class);
        $blueprint = new Blueprint('test');
        $blueprint->multipoint('foo', 'UNSUPPORTED_ENTRY', 27700);
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());
        $this->assertCount(1, $statements);;
    }

    public function testAddingMultiLinestring()
    {
        $blueprint = new Blueprint('test');
        $blueprint->multilinestring('foo');
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());

        $this->assertCount(1, $statements);;
        $this->assertStringContainsString('GEOGRAPHY(MULTILINESTRING, 4326)', $statements[0]);
    }

    public function testAddingMultiLinestringGeom()
    {
        $blueprint = new Blueprint('test');
        $blueprint->multilinestring('foo', 'GEOMETRY', 27700);
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());
        $this->assertCount(1, $statements);;
        $this->assertStringContainsString('GEOMETRY(MULTILINESTRING, 27700)', $statements[0]);
    }

    public function testAddingMultiLinestringWrongSrid()
    {
        $this->expectException(UnsupportedGeomtypeException::class);
        $blueprint = new Blueprint('test');
        $blueprint->multilinestring('foo', 'GEOGRAPHY', 27700);
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());
        $this->assertCount(1, $statements);;
    }

    public function testAddingMultiLinestringUnsupported()
    {
        $this->expectException(UnsupportedGeomtypeException::class);
        $blueprint = new Blueprint('test');
        $blueprint->multilinestring('foo', 'UNSUPPORTED_ENTRY', 27700);
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());
        $this->assertCount(1, $statements);;
    }

    public function testAddingMultiPolygon()
    {
        $blueprint = new Blueprint('test');
        $blueprint->multipolygon('foo');
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());

        $this->assertCount(1, $statements);;
        $this->assertStringContainsString('GEOGRAPHY(MULTIPOLYGON, 4326)', $statements[0]);
    }

    public function testAddingMultiPolygonGeom()
    {
        $blueprint = new Blueprint('test');
        $blueprint->multipolygon('foo', 'GEOMETRY', 27700);
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());
        $this->assertCount(1, $statements);;
        $this->assertStringContainsString('GEOMETRY(MULTIPOLYGON, 27700)', $statements[0]);
    }

    public function testAddingMultiPolygonWrongSrid()
    {
        $this->expectException(UnsupportedGeomtypeException::class);
        $blueprint = new Blueprint('test');
        $blueprint->multipolygon('foo', 'GEOGRAPHY', 27700);
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());
        $this->assertCount(1, $statements);;
    }

    public function testAddingMultiPolygonUnsupported()
    {
        $this->expectException(UnsupportedGeomtypeException::class);
        $blueprint = new Blueprint('test');
        $blueprint->multipolygon('foo', 'UNSUPPORTED_ENTRY', 27700);
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());
        $this->assertCount(1, $statements);;
    }

    public function testAddingGeography()
    {
        $blueprint = new Blueprint('test');
        $blueprint->geography('foo');
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());

        $this->assertCount(1, $statements);;
        $this->assertStringContainsString('GEOGRAPHY', $statements[0]);
    }

    public function testAddingGeometry()
    {
        $blueprint = new Blueprint('test');
        $blueprint->geometry('foo');
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());
        $this->assertCount(1, $statements);;
        $this->assertStringContainsString('GEOMETRY', $statements[0]);
    }

    public function testAddingGeometryCollection()
    {
        $blueprint = new Blueprint('test');
        $blueprint->geometrycollection('foo');
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());

        $this->assertCount(1, $statements);;
        $this->assertStringContainsString('AddGeometryColumn', $statements[0]);
        $this->assertStringContainsString('GEOMETRYCOLLECTION', $statements[0]);
    }

    public function testEnablePostgis()
    {
        $blueprint = new Blueprint('test');
        $blueprint->enablePostgis();
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());

        $this->assertCount(1, $statements);;
        $this->assertStringContainsString('CREATE EXTENSION postgis', $statements[0]);
    }

    public function testEnablePostgisIfNotExists()
    {
        $blueprint = new Blueprint('test');
        $blueprint->enablePostgisIfNotExists();
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());

        $this->assertCount(1, $statements);;
        $this->assertStringContainsString('CREATE EXTENSION IF NOT EXISTS postgis', $statements[0]);
    }

    public function testDisablePostgis()
    {
        $blueprint = new Blueprint('test');
        $blueprint->disablePostgis();
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());

        $this->assertCount(1, $statements);;
        $this->assertStringContainsString('DROP EXTENSION postgis', $statements[0]);
    }

    public function testDisablePostgisIfExists()
    {
        $blueprint = new Blueprint('test');
        $blueprint->disablePostgisIfExists();
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());

        $this->assertCount(1, $statements);;
        $this->assertStringContainsString('DROP EXTENSION IF EXISTS postgis', $statements[0]);
    }

    /**
     * @return Connection
     */
    protected function getConnection()
    {
        return Mockery::mock(PostgisConnection::class);
    }

    protected function getGrammar()
    {
        return new PostgisGrammar();
    }

    public function testAddingGinIndex()
    {
        $blueprint = new Blueprint('test');
        $blueprint->gin('foo');
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());

        $this->assertEquals(1, count($statements));
		
        $this->assertStringContainsString('CREATE INDEX', $statements[0]);
        $this->assertStringContainsString('GIN("foo")', $statements[0]);
    }
    
    public function testAddingGistIndex()
    {
        $blueprint = new Blueprint('test');
        $blueprint->gist('foo');
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());

        $this->assertEquals(1, count($statements));
        $this->assertStringContainsString('CREATE INDEX', $statements[0]);
        $this->assertStringContainsString('GIST("foo")', $statements[0]);
    }

    public function testAddingCharacter()
    {
        $blueprint = new Blueprint('test');
        $blueprint->character('foo', 14);
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());

        $this->assertEquals(1, count($statements));
        $this->assertStringContainsString('alter table', $statements[0]);
        $this->assertStringContainsString('add column "foo" character(14)', $statements[0]);
    }

    public function testAddingHstore()
    {
        $blueprint = new Blueprint('test');
        $blueprint->hstore('foo');
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());

        $this->assertEquals(1, count($statements));
        $this->assertStringContainsString('alter table', $statements[0]);
        $this->assertStringContainsString('add column "foo" hstore', $statements[0]);
    }

    public function testAddingUuid()
    {
        $blueprint = new Blueprint('test');
        $blueprint->uuid('foo');
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());

        $this->assertEquals(1, count($statements));
        $this->assertStringContainsString('alter table', $statements[0]);
        $this->assertStringContainsString('add column "foo" uuid', $statements[0]);
    }

    public function testAddingJsonb()
    {
        $blueprint = new Blueprint('test');
        $blueprint->jsonb('foo');
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());

        $this->assertEquals(1, count($statements));
        $this->assertStringContainsString('alter table', $statements[0]);
        $this->assertStringContainsString('add column "foo" jsonb', $statements[0]);
    }

    public function testAddingInt4range()
    {
        $blueprint = new Blueprint('test');
        $blueprint->int4range('foo');
        $statements = $blueprint->toSql(
            $this->getConnection(),
            $this->getGrammar()
        );

        $this->assertEquals(1, count($statements));
        $this->assertStringContainsString('alter table', $statements[0]);
        $this->assertStringContainsString('add column "foo" int4range', $statements[0]);
    }

    public function testAddingInt8range()
    {
        $blueprint = new Blueprint('test');
        $blueprint->int8range('foo');
        $statements = $blueprint->toSql(
            $this->getConnection(),
            $this->getGrammar()
        );

        $this->assertEquals(1, count($statements));
        $this->assertStringContainsString('alter table', $statements[0]);
        $this->assertStringContainsString('add column "foo" int8range', $statements[0]);
    }

    public function testAddingNumrange()
    {
        $blueprint = new Blueprint('test');
        $blueprint->numrange('foo');
        $statements = $blueprint->toSql(
            $this->getConnection(),
            $this->getGrammar()
        );

        $this->assertEquals(1, count($statements));
        $this->assertStringContainsString('alter table', $statements[0]);
        $this->assertStringContainsString('add column "foo" numrange', $statements[0]);
    }

    public function testAddingTsrange()
    {
        $blueprint = new Blueprint('test');
        $blueprint->tsrange('foo');
        $statements = $blueprint->toSql(
            $this->getConnection(),
            $this->getGrammar()
        );

        $this->assertEquals(1, count($statements));
        $this->assertStringContainsString('alter table', $statements[0]);
        $this->assertStringContainsString('add column "foo" tsrange', $statements[0]);
    }

    public function testAddingTstzrange()
    {
        $blueprint = new Blueprint('test');
        $blueprint->tstzrange('foo');
        $statements = $blueprint->toSql(
            $this->getConnection(),
            $this->getGrammar()
        );

        $this->assertEquals(1, count($statements));
        $this->assertStringContainsString('alter table', $statements[0]);
        $this->assertStringContainsString('add column "foo" tstzrange', $statements[0]);
    }

    public function testAddingDatarange()
    {
        $blueprint = new Blueprint('test');
        $blueprint->daterange('foo');
        $statements = $blueprint->toSql(
            $this->getConnection(),
            $this->getGrammar()
        );

        $this->assertEquals(1, count($statements));
        $this->assertStringContainsString('alter table', $statements[0]);
        $this->assertStringContainsString('add column "foo" daterange', $statements[0]);
    }
    
    public function testAddingTsvector()
    {
        $blueprint = new Blueprint('test');
        $blueprint->tsvector('foo');
        $statements = $blueprint->toSql(
            $this->getConnection(),
            $this->getGrammar()
        );
        
        $this->assertEquals(1, count($statements));
        $this->assertStringContainsString('alter table', $statements[0]);
        $this->assertStringContainsString('add column "foo" tsvector', $statements[0]);
    }	
}
