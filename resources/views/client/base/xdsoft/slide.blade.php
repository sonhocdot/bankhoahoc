@if(!empty($fileList))
    @for($i=0;$i<count($fileList);$i++)
        @if($i==0)

                <div class="tab-content" id="myTabContent" style="overflow-x: hidden;">
                    <div class="tab-pane fade show active" id="slide{{$i}}" role="tabpanel">
                        @else
                            <div class="tab-pane fade" id="slide{{$i}}" role="tabpanel">
                                @endif
                                <div class="owl-carousel owl-services">
                                    @foreach(glob($fileList[$i].'/*') as $img)
                                        <div class="slide-item mx-2 mx-2">
                                            <a href="{{asset($img)}}" data-fancybox="group{{$i}}"
                                               data-caption="This image has a caption 1">
                                                <img class="rounded" src="{{asset($img)}}" alt=""/>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endfor
                    </div>




                <ul class="nav justify-content-center mt-2" id="myTab" role="tablist" style="color: #a30000">
                    @for($i=0;$i<count($fileList);$i++)
                        <li class="nav-item" role="presentation">
                            @if($i==0)
                                <button class="nav-link active shadow" id="apartment-tab" data-bs-toggle="tab"
                            @else
                                <button class="nav-link shadow" id="apartment-tab" data-bs-toggle="tab"
                                        @endif

                                        data-bs-target="#slide{{$i}}"
                                        type="button" role="tab" aria-controls="0" aria-selected="true"
                                        style="">{{ucfirst(str_replace('slide/','',$fileList[$i]))}}
                                </button>
                        </li>

                    @endfor
                </ul>
        @endif
