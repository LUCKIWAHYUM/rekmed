<div class="row">
    <div class="col-12">
        <div class="my-4 mb-2">
            <input wire:model="searchFilter" type="text" class="form-control form-control-solid form-control-lg py-4" placeholder="Search...">
            <div class="d-flex mt-4 align-items-center">
                <div class=""><p class="mb-0">Menampilkan data sebanyak <span class="fw-bold">{{ $searchCount }}</span>.</p></div>
                <div class="ms-auto">
                    <button class="btn btn-outline btn-sm justify-content-end"
                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                        data-kt-menu-overflow="true">
                        <i class="ki-outline ki-filter fs-7 me-n1"></i>
                        <span class="mb-0">Filter</span>
                    </button>

                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-300px"
                        data-kt-menu="true">
                        <div class="menu-item px-3">
                            <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">Atur berdasarkan</div>
                        </div>
                        <div class="separator mb-3 opacity-75"></div>
                        <div class="px-7 py-5 menu-item" data-kt-docs-table-filter="status_type">
                            <div class="form-group mb-5">
                                <label class="form-label mb-3">Tipe</label>
                                <select class="form-select form-select-solid" wire:model="filterType">
                                    <option value="">Pilih salah satu</option>
                                    @foreach ([1,2] as $type)
                                        @if (!empty($valueType))
                                            @php $selected = $type == $valueType ? 'selected' : '' @endphp
                                            @php $name = $type == 1 ? 'Do Follow' : 'No Follow' @endphp
                                            <option value="{{ $type }}" {{ $selected }}>{{ $name }}</option>
                                        @else
                                            @php $name = $type == 1 ? 'Do Follow' : 'No Follow' @endphp
                                            <option value="{{ $type }}">{{ $name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-5">
                                <label class="form-label mb-3">Kategori</label>
                                <select class="form-select form-select-solid input-kategori" wire:model="categoryFilter">
                                    <option value="">Pilih salah satu</option>
                                    @foreach ($getListCategory as $category)
                                        @if (!empty($valueCategory))
                                            @php $selected = $category == $valueCategory ? 'selected' : '' @endphp
                                            <option value="{{ $category->name }}" {{ $selected }}>{{ $category->name }}</option>
                                        @else
                                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-5">
                                <label class="form-label mb-3">Harga</label>
                                <div class="row">
                                    <div class="col">
                                        <input type="number" min="0" max="50000000" wire:model="minimumPrice" class="form-control form-control-solid" value="{{ !empty($valueMinimumPrice) ? $valueMinimumPrice : 0 }}"/>
                                    </div>
                                    <div class="col">
                                        <input type="number" min="0" max="50000000" wire:model="maximumPrice" class="form-control form-control-solid" value="{{ !empty($valueMaximumPrice) ? $valueMinimumPrice : 0 }}"/>
                                    </div>
                                </div>
                            </div>
                            @if(filterExists())
                                <div class="mt-4">
                                    <a href="{{ route('user.sites') }}" class="btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary w-100">Atur Ulang</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="my-8">
            @foreach($sites as $site)
                <div class="col-12 mb-3 pageDetail">
                    <div class="card">
                        <div class="card-body d-flex p-0 align-items-center">
                            <div class="">
                                <div class="card-body">
                                    <h4 class="card-title fw-bold"><a href="{{ site_url('user', 'sites/p') . '/' . $site->id }}">{{ removeUrlPrefix($site->url) }}</a></h4>
                                    <p class="card-text d-flex text-muted mb-0">
                                        <span class="badge bg-light text-dark">
                                            @if (!empty($site->is_url_category))
                                                {{ $site->is_url_category }}
                                            @else
                                                Uncategorized
                                            @endif
                                        </span>
                                        <span class="ms-2 badge bg-light-primary text-primary">
                                            @if($site->is_type == enum('isSiteTypeDoFollow'))
                                                Do Follow
                                            @else
                                                No Follow
                                            @endif
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex ms-auto align-items-center">
                                <div class="border-start border-end text-center d-none d-md-block">
                                    <div class="card-body">
                                        <h4 class="card-title fw-bold">DA</h4>
                                        <p class="card-text text-muted mb-0">{{ $site->is_domain_authority }}</p>
                                    </div>
                                </div>
                                <div class="border-end text-center d-none d-md-block">
                                    <div class="card-body">
                                        <h4 class="card-title fw-bold">PA</h4>
                                        <p class="card-text text-muted mb-0">{{ $site->is_page_authority }}</p>
                                    </div>
                                </div>
                                <div class="border-end text-center d-none d-md-block">
                                    <div class="card-body">
                                        <h4 class="card-title fw-bold">HARGA</h4>
                                        <p class="card-text text-muted mb-0">{{ rupiah_changer($site->is_post_price) }}</p>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="card-body">
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Keranjang" href="{{ site_url('user', 'sites/add-to-cart/s') . '/' . $site->id }}" noopener noreferrer>
                                            <i class="ki-duotone ki-handcart fs-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        <ul class="pagination pagination-outline">
            @if ($sites->onFirstPage())
                <li class="page-item previous disabled"><span class="page-link"><i class="previous"></i></span></li>
            @else
                <li class="page-item"><a href="{{ $sites->previousPageUrl() }}" class="page-link"><i class="previous"></i></a></li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item"><span class="page-link">{{ $element }}</span></li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @php
                            $pattern = '/\/livewire\/message\/([A-Za-z0-9_\.]+)\?/';
                            $replacement = '/user/sites?';
                            $urls = preg_replace($pattern, $replacement, $url);
                        @endphp
                        @if ($page == $sites->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a href="{{ $urls }}" class="page-link">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($sites->hasMorePages())
                <li class="page-item"><a href="{{ $sites->nextPageUrl() }}" class="page-link"><i class="next"></i></a></li>
            @else
                <li class="page-item next disabled"><span class="page-link"><i class="next"></i></span></li>
            @endif
        </ul>
    </div>
</div>