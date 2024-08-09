<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;

class ApiFilter {
    protected $safeParams = [];

    protected $columnMap = [];

    protected $operatorMap = [];

    public function transform(Request $request) {
        $eloquentQuery = [];

        foreach ($this->safeParams as $param => $operators) {
            $query = $request->query($param);

            // guard clause
            if (! isset($query)) {
                continue;
            }

            $column = $this->columnMap[$param] ?? $param;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $eloquentQuery[] = [
                        $column,
                        $this->operatorMap[$operator],
                        $query[$operator]
                    ];
                }
            }
        }

        return $eloquentQuery; // for example the return is ['column what you want', 'operator what you want', 'value what you want']
    }
}
