<?php

namespace App\Http\Livewire\Modules\User;

use Livewire\Component;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

use Modules\Seller\Entities\SitesModel as Sites;
use Modules\Seller\Entities\SitesCategoryModel as SitesCategory;
use Modules\User\Entities\CartModel as Carts;
use App\Enums\GlobalEnum;
use WithPagination;

class Site extends Component
{
    public $filterType;
    public $categoryFilter;
    public $searchFilter = '';
    public $minimumPrice;
    public $maximumPrice;
    
    public $currentPage = 1;
    public $perPage = 10;

    public function render(Request $request)
    {

        $valueType = '';
        $valueCategory = '';
        $valueMinimumPrice = '';
        $valueMaximumPrice = '';

        if(!empty($request->input('filterType')) || !empty($request->input('categoryFilter')) || !empty($request->input('minimumPrice')) || !empty($request->input('maximumPrice')))
        {
            $this->filterType = $request->filterType;
            $this->categoryFilter = $request->categoryFilter;
            $this->minimumPrice = $request->minimumPrice;
            $this->maximumPrice = $request->maximumPrice;

            $valueType = $request->filterType;
            $valueCategory = $request->categoryFilter;
            $valueMinimumPrice = $request->minimumPrice;
            $valueMaximumPrice = $request->maximumPrice;
        }
        
        $query = Sites::where('is_status', GlobalEnum::isSiteActive);

        if (!empty($this->filterType)) {
            $query->where('is_type', $this->filterType);
        }

        if (!empty($this->categoryFilter)) {
            $query->where('is_url_category', 'like', '%' . $this->categoryFilter . '%');
        }

        if (!empty($this->minimumPrice) || !empty($this->maximumPrice)) {
            $query->whereBetween('is_post_price', [$this->minimumPrice, $this->maximumPrice]);
        }

        if (!empty($this->searchFilter)) {
            $query->where('url', 'like', '%' . $this->searchFilter . '%');
        }

        $sites = $query->paginate($this->perPage)->appends([
            'filterType' => $this->filterType,
            'categoryFilter' => $this->categoryFilter,
            'minimumPrice' => $this->minimumPrice,
            'maximumPrice' => $this->maximumPrice,
        ]);
        
        $elements = $sites->links()->elements;
        $searchCount = $sites->total();
        $getListCategory = SitesCategory::where('is_status', GlobalEnum::isActive)->get();

        return view('livewire.modules.user.site', 
            compact('sites', 'elements', 'searchCount', 'getListCategory', 'valueType', 'valueCategory', 'valueMinimumPrice', 'valueMaximumPrice')
        );
    }

    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
        }
    }

    public function nextPage()
    {
        $this->currentPage++;
    }

    public function goToPage($page)
    {
        $url = route('user.sites.view', ['id' => $page]);
        return redirect()->to($url);
    }
}