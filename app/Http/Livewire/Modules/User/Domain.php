<?php

namespace App\Http\Livewire\Modules\User;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

use Modules\Seller\Entities\DomainModel as Domains;
use Modules\User\Entities\CartModel as Carts;

use App\Enums\GlobalEnum;
use WithPagination;

class Domain extends Component
{
    public $searchFilter = '';
    public $minimumPrice;
    public $maximumPrice;
    
    public $currentPage = 1;
    public $perPage = 10;

    public function render(Request $request)
    {

        $valueMinimumPrice = '';
        $valueMaximumPrice = '';

        if(!empty($request->input('minimumPrice')) || !empty($request->input('maximumPrice')))
        {
            $this->minimumPrice = $request->minimumPrice;
            $this->maximumPrice = $request->maximumPrice;

            $valueMinimumPrice = $request->minimumPrice;
            $valueMaximumPrice = $request->maximumPrice;
        }
        
        $query = Domains::where('is_status', GlobalEnum::isSiteActive);

        if (!empty($this->minimumPrice) || !empty($this->maximumPrice)) {
            $query->whereBetween('is_post_price', [$this->minimumPrice, $this->maximumPrice]);
        }

        if (!empty($this->searchFilter)) {
            $check_query = $query->where('url', 'like', '%' . $this->searchFilter . '%')->count();
            if($check_query == 0) {
                $query->where('is_url_from_website', 'like', '%' . $this->searchFilter . '%');
            } else {
                $query->where('url', 'like', '%' . $this->searchFilter . '%');
            }
        }

        $sites = $query->paginate($this->perPage)->appends([
            'minimumPrice' => $this->minimumPrice,
            'maximumPrice' => $this->maximumPrice,
        ]);
        
        $elements = $sites->links()->elements;
        $searchCount = $sites->total();

        return view('livewire.modules.user.domain', 
            compact('sites', 'elements', 'searchCount', 'valueMinimumPrice', 'valueMaximumPrice')
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
        $url = route('user.domain.view', ['id' => $page]);
        return redirect()->to($url);
    }
}