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

namespace Vendor\MongoDB\Model;

use Iterator;

/**
 * CollectionInfoIterator interface.
 *
 * This iterator is used for enumerating collections in a database.
 *
 * @api
 * @see \MongoDB\Database::listCollections()
 */
interface CollectionInfoIterator extends Iterator
{
    /**
     * Return the current element as a CollectionInfo instance.
     *
     * @return CollectionInfo
     */
    public function current();
}
