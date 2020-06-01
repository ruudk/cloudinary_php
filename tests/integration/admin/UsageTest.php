<?php
/**
 * This file is part of the Cloudinary PHP package.
 *
 * (c) Cloudinary
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cloudinary\Test\Api\Admin;

use Cloudinary\Api\Exception\ApiError;
use Cloudinary\Test\Api\IntegrationTestCase;
use PHPUnit_Framework_Constraint_IsType as IsType;

/**
 * Class UsageTest
 */
final class UsageTest extends IntegrationTestCase
{
    /**
     * Get account usage details
     *
     * @throws ApiError
     */
    public function testGetAccountUsageDetails()
    {
        $result = self::$adminApi->usage();

        $this->assertNotEmpty($result);
        self::assertObjectStructure(
            $result,
            [
                'plan' => IsType::TYPE_STRING,
                'last_updated' => IsType::TYPE_STRING,
                'transformations' => IsType::TYPE_ARRAY,
                'objects' => IsType::TYPE_ARRAY,
                'bandwidth' => IsType::TYPE_ARRAY,
                'storage' => IsType::TYPE_ARRAY,
                'requests' => IsType::TYPE_INT,
                'resources' => IsType::TYPE_INT,
                'derived_resources' => IsType::TYPE_INT,
                'media_limits' => IsType::TYPE_ARRAY,
            ]
        );
    }

    /**
     * Tests that different Admin API calls all include the rate limits
     *
     * For each Admin API call, standard HTTP headers are returned with details on your current usage statistics,
     * including your per-hour limit, remaining number of actions and the time the hourly count will be reset.
     * These HTTP headers are made part of the ApiResponse by the SDK.
     */
    public function testRateLimits()
    {
        $results[] = self::$adminApi->ping();
        $results[] = self::$adminApi->rootFolders();
        $results[] = self::$adminApi->resourceTypes();

        foreach ($results as $result) {
            self::assertObjectStructure(
                $result,
                [
                    'rateLimitResetAt' => IsType::TYPE_INT,
                    'rateLimitAllowed' => IsType::TYPE_INT,
                    'rateLimitRemaining' => IsType::TYPE_INT
                ]
            );
        }
    }
}