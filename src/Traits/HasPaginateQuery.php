<?php

namespace Fintech\Core\Traits;

use Fintech\Core\Supports\Constant;

/**
 * Trait HasPaginateQuery
 */
trait HasPaginateQuery
{
    /**
     * this method return all option available for index page
     * pagination query handle before it reach controller
     *
     * Query Strings :
     * sort => sorting column name
     * dir => is ASC or Desc ordering
     * paginate => receive collection or paginate response
     * per_page => how many item per request
     * page  => to which slot want to pull data
     */
    protected function getPaginateOptions(): array
    {
        $options['sort'] = $this->input('sort') ?? 'id';
        $options['dir'] = $this->input('dir') ?? 'asc';
        $options['per_page'] = $this->input('per_page') ?? array_key_first(Constant::PAGINATE_LENGTHS);
        $options['page'] = $this->input('page') ?? 1;
        $options['paginate'] = true;
        $options['trashed'] = false;

        $paginateInput = $this->input('paginate', '');
        $trashedInput = $this->input('trashed', '');

        if ($paginateInput != null && strlen($paginateInput) != 0) {
            $options['paginate'] = $this->boolean('paginate') ?? true;
        }
        if ($trashedInput != null && strlen($trashedInput) != 0) {
            $options['trashed'] = $this->boolean('trashed') ?? true;
        }

        return $options;
    }

    /**
     * Manipulate the list request of index method
     * If you need to overwrite the method use `getPaginateOptions`
     * method to attach pagination option to request
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge($this->getPaginateOptions());
    }
}
