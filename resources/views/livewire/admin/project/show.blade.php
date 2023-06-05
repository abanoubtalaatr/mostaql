<main class="main-content">
    <x-admin.head/>
    <!--campaign-->
    <div class="border-div">
        <div class="b-btm">
            <h4>{{$page_title}}</h4>
        </div>
        <div class="row mt-30">
            <div class="table-page-wrap">
                <div class="row">
                    <table class='table table-responsive'>
                        <tr>
                            <td class='text-bold'>@lang('site.title')</td>
                            <td>{{$project->title}}</td>
                        </tr>

                        <tr>
                            <td class='text-bold'>@lang('site.category')</td>
                            <td>{{ $project->category->title_ar}}</td>
                        </tr>

                        <tr>
                            <td class='text-bold'>@lang('site.user')</td>
                            <td>{{$project->user->first_name . ' '. $project->user->last_name}}</td>
                        </tr>

                        <tr>
                            <td class='text-bold'>@lang('site.description')</td>
                            <td>{{$project->description_ar}}</td>
                        </tr>

                        <tr>
                            <td class='text-bold'>@lang('site.price')</td>
                            <td>{{$project->price}}</td>
                        </tr>
                        <tr>
                            <td class='text-bold'>@lang('site.number_of_days')</td>
                            <td>{{$project->number_of_days}}</td>
                        </tr>

                        @if(isset($project->file))
                            <tr>
                                <td class='text-bold'>@lang('site.file')</td>
                                <td>
                                    <a target="_blank" href="{{url('uploads/pics/'. $project->file)}}">المرفق</a>
                                </td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
