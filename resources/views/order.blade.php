@extends('layouts.user_type.auth')

@section('content')
  <div class="py-4">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card mb-4">
            <div class="row ">
              <div class="col">
                <div class=""> <!-- Add d-flex class here -->
                    <div class="card-header pb-0">
                        <h6>Buyurtmalar</h6>
                    </div>
                    <div class="d-flex p-2 pb-0 mx-2 ">
                        <form action="{{ route('orders') }}" method="POST">
                          @csrf
                          <input type="hidden" name="status" value="3">
                          <button type="submit" class="btn rounded p-1 px-3 btn-light mx-2"><i style="font-size: 16px" class="fas fa-question-circle -warning"></i></button>
                        </form>
                        <form action="{{ route('orders') }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="1">
                            <button type="submit" class="btn p-1 px-3 btn-light"><i style="font-size: 16px" class="fas fa-check -success"></i></button>
                        </form>
                        <form action="{{ route('orders') }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="2">
                            <button type="submit" class="btn p-1 px-3 btn-light mx-2"><i style="font-size: 16px" class="fas fa-times -danger"></i></button>
                        </form>
                        <a href="{{ route('order')}}" type="submit" class="btn p-1 px-3 btn-light "><i style="font-size: 16px" class="fas fa-list-alt -secondary"></i></a>
                    </div>
                </div>
            </div>
            
                {{-- @can('factory')
                  <div class="col-sm-12 col-md-5 col-xl-4 m-4">
                      <div>
                          <div class="row d-flex justify-content-md-end">
                              <a href="#" data-bs-toggle="modal" data-bs-target="#createOrder" class=" btn bg-gradient-primary btn-sm col-6" type="button">+&nbsp;
                                  Buyurtma
                              </a>
                          </div>
                          <div class="modal fade" id="createOrder" tabindex="-1"
                              aria-labelledby="createOrderLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="createOrderLabel">Buyurtma yaratish</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>      
                                      <div class="modal-body">
                                        <x-order-create :categories="$categories"></x-order-create>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  @endcan --}}
                  
                  <div class="card-body pt-4 p-3">
                    <ul class="list-group">
                      @foreach ($orders as $order)
                        <li class="list-group-item border-0 d-md-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                          <div class="d-flex flex-column">
                              <h6 class="mb-3 text-sm"><span class="fw-bold">№ {{ $order->id }}</span> {{ $order->area}}, {{ $order->address }}</h6>
                              <span class="mb-2 text-xs">Buyurtmachi: <span class="text-dark font-weight-bold ms-sm-2">{{ $order->user->name }}</span></span>
                              @php
                                  $categoryIds = explode('#', $order->category_id);
                                  $weights = explode('#', $order->weight);
                              @endphp
                              <div class="border">
                                @foreach ($categoryIds as $key => $category)
                                    <p class="mb-2 text-xs">
                                        <span class="text-dark ms-sm-2 bg-light font-weight-bold">{{ $category }}
                                        - {{ $weights[$key] }}kg</span>
                                    </p>
                                @endforeach
                              </div>
                              <a class="mt-2 px-2 text-sm mb-1 shadow-none bg-secondary text-light rounded" href="tel:{{ $order->user->phone_number }}"> Telefon: {{ $order->user->phone_number }}</a>                          
                              <span class="text-xs">{{ $order->created_at }}</span>
                          </div>
                          <div class="ms-auto text-end">
                           
                            @if ($order->status == 3)   
                              @can('admin')
                                <div class="btn-group  mt-3">
                                  <form method="POST" action="{{ route('order.reject', $order) }}">
                                    @csrf
                                    <input type="hidden" value="{{ auth()->user()->name }}" name="edited">
                                    <button type="submit" class="btn btn-sm btn-gray text-danger shadow-none m-2  mx-5 p-1">Rad etish</button>
                                  </form>
                                  <form method="POST" action="{{ route('order.accept', $order) }}">
                                    @csrf
                                    <input type="hidden" name="edited" value="{{ auth()->user()->name }}">
                                    <button type="submit" class="btn btn-sm p-2 btn-success shadow-none m-1">Qabul qilish</button>
                                  </form>
                                </div>  
                              @endcan
                              @can('agent')
                                <form method="POST" action="{{ route('order.acceptAgent', $order) }}">
                                  @csrf
                                  <input type="hidden" name="edited" value="{{ auth()->user()->name }}">
                                  <input type="hidden" name="attachment" value="{{  auth()->user()->id }}">
                                  <button type="submit" class="btn btn-sm p-2 btn-success shadow-none m-1">Qabul qilish</button>
                                </form>
                              @endcan
                            @endif
                             @if ( $order->status)
                                @if ( $order->status == 1)
                                  <p class="btn btn-sm btn-link text-light px-5 mt-3 mb-0 shadow-none bg-info">Qabul qilindi</p>
                                @elseif ( $order->status == 2)
                                  <p class="btn btn-sm btn-link text-light px-5 mt-3 mb-0 shadow-none bg-danger">Rad etildi</p>
                                @endif
                            @endif   
                            @can('factory')
                                @if ( $order->status == 3)
                                <p class="btn btn-sm btn-link text-dark px-5 mt-3 mb-0 shadow-none bg-warning">Ko'rib chiqilmoqda</p>
                              @endif
                            @endcannot               
                            <br>
                            @if ($order->attachment == null && $order->status != 2)
                              @can('admin')
                                  <form id="attachOrderForm" action="{{ route('order.attach', ['id' => $order->id]) }}" method="POST">
                                      @method('PUT')
                                      @csrf
                                      <div class="input-group mb-3">
                                      <select id="attachmentSelect" required name="attachment" class="form-select form-select-sm mt-3" aria-label="Default select example">
                                          <option disabled selected>Agent biriktirish</option>
                                          @foreach ($users->where('role_id', 3) as $agent)
                                              <option value="{{ $agent->id }}">{{ $agent->name }}</option>                                  
                                          @endforeach
                                      </select>
                                      <input type="hidden" name="status" value="1">
                                      <div class="input-group-text  btn-success p-0" style="height: 40px;margin-top: 16px;">
                                          <input class="form-check-input mt-0  btn-success text-white" style="padding: 0px 30px 0px 10px;" type="submit" value=" ↪" aria-label="Checkbox for following text input">
                                      </div>
                                    </div>
                                  </form>
                              @endcan
                            @else
                              @if ($order)
                                <input type="text" disabled class="form-control form-control-sm mt-3" id="formGroupExampleInput" placeholder="{{ $order->attachment ? (\App\Models\User::find($order->attachment) ? \App\Models\User::find($order->attachment)->name : 'No User Found') : 'No Attachment Found' }}">
                              @endif
                            @endif
                          </div>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                  @include('layouts.pagination', ['paginator' => $orders])
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection

