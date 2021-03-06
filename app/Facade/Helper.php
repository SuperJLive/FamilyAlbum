<?php

namespace App\Facade;

use Illuminate\Support\Facades\Facade;
/**
 * Class Helpers.
 *
 * Provides static access to methods of {@link \App\Assets\Helpers}.
 *
 * @internal keep the list of documented method in sync with
 * {@link \App\Assets\Helpers}
 *
 * @method static string cacheBusting(string $filePath)
 * @method static string getDeviceType()
 * @method static string generateID()
 * @method static string trancateIf32(string $id, int $prevShortId = 0)
 * @method static string getExtension(string $filename, bool $isURI = false)
 * @method static bool hasPermissions(string $path)
 * @method static bool hasFullPermissions(string $path):
 * @method static int gcd(int $a, int $b)
 * @method static string str_of_bool(bool $b)
 * @method static string ex2x(string $filename)
 * @method static int data_index()
 * @method static int data_index_r()
 * @method static void data_index_set(int $idx = 0)
 */
class Helper extends Facade
{
	protected static function getFacadeAccessor(): string
	{
		return 'Helpers';
	}
    public static function test()
    {
        return 'OK';
    }
}
