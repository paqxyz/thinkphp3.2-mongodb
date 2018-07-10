<?php
/*
 * Copyright 2015-2017 MongoDB, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Vendor\MongoDB\Operation;

use Vendor\MongoDB\DeleteResult;
use MongoDB\Driver\Server;
use MongoDB\Driver\Exception\RuntimeException as DriverRuntimeException;
use Vendor\MongoDB\Exception\InvalidArgumentException;
use Vendor\MongoDB\Exception\UnsupportedException;

/**
 * Operation for deleting a single document with the delete command.
 *
 * @api
 * @see \MongoDB\Collection::deleteOne()
 * @see http://docs.mongodb.org/manual/reference/command/delete/
 */
class DeleteOne implements Executable
{
    private $delete;

    /**
     * Constructs a delete command.
     *
     * Supported options:
     *
     *  * collation (document): Collation specification.
     *
     *    This is not supported for server versions < 3.4 and will result in an
     *    exception at execution time if used.
     *
     *  * writeConcern (MongoDB\Driver\WriteConcern): Write concern.
     *
     * @param string       $databaseName   Database name
     * @param string       $collectionName Collection name
     * @param array|object $filter         Query by which to delete documents
     * @param array        $options        Command options
     * @throws InvalidArgumentException for parameter/option parsing errors
     */
    public function __construct($databaseName, $collectionName, $filter, array $options = [])
    {
        $this->delete = new Delete($databaseName, $collectionName, $filter, 1, $options);
    }

    /**
     * Execute the operation.
     *
     * @see Executable::execute()
     * @param Server $server
     * @return DeleteResult
     * @throws UnsupportedException if collation is used and unsupported
     * @throws DriverRuntimeException for other driver errors (e.g. connection errors)
     */
    public function execute(Server $server)
    {
        return $this->delete->execute($server);
    }
}
