@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4" xmlns="http://www.w3.org/1999/html">
        <div class="game-details border-b border-gray-800 pb-12 flex flex-col lg:flex-row">
            <div class="flex-none">
                <img src="{{ $game['coverImageUrl'] }}" alt="cover">
            </div>
            <div class="lg:ml-12 lg:mr-64">
                <h2 class="font-semibold text-4xl leading-tight mt-1">{{ $game['name'] }}</h2>
                <div class="text-gray-400">
                    <span>
                        {{ $game['genre'] }}
                    </span>
                    &middot;
                    <span>{{ $game['involvedCompanies'] }}</span>
                    &middot;
                    <span>
                        {{ $game['platforms'] }}
                    </span>
                </div>

                <div class="flex flex-wrap items-center mt-8">
                    <div class="flex items-center">
                        <div id="memberRating" class="w-16 h-16 bg-gray-800 rounded-full relative text-sm">
                            @push('scripts')
                                @include('_rating', [
                                    'slug' => 'memberRating',
                                    'rating' => $game['memberRating'],
                                    'event' => null,
                                ])
                            @endpush
                        </div>
                        <div class="ml-4 text-xs">Member <br> Score</div>
                    </div>
                    <div class="flex items-center ml-12">
                        <div id="criticRating" class="w-16 h-16 bg-gray-800 rounded-full relative text-sm">
                            @push('scripts')
                                @include('_rating', [
                                    'slug' => 'criticRating',
                                    'rating' => $game['criticRating'],
                                    'event' => null,
                                ])
                            @endpush
                        </div>
                        <div class="ml-4 text-xs">Critic <br> Score</div>
                    </div>
                    <div class="flex items-center space-x-4 mt-4 lg:mt-0 lg:ml-12">
                        @if ($game['social']['website'])
                            <div class="w-8 h-8 bg-gray-800 rounded-full flex justify-center items-center">
                                <a href={{ $game['social']['website']['url'] }} class="hover:text-gray-400">
                                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 32 32"
                                         width="32" height="32">
                                        <title>earth--filled</title>
                                        <path
                                            d="M16,2A14,14,0,1,0,30,16,14.0158,14.0158,0,0,0,16,2ZM4.02,16.394l1.3384.4458L7,19.3027v1.2831a1,1,0,0,0,.2929.7071L10,24v2.3765A11.9941,11.9941,0,0,1,4.02,16.394ZM16,28a11.9682,11.9682,0,0,1-2.5718-.2847L14,26l1.8046-4.5116a1,1,0,0,0-.0964-.9261l-1.4113-2.117A1,1,0,0,0,13.4648,18h-4.93L7.2866,16.1274,9.4141,14H11v2h2V13.2656l3.8682-6.7695-1.7364-.9922L14.2769,7H11.5352l-1.086-1.6289A11.861,11.861,0,0,1,20,4.7V8a1,1,0,0,0,1,1h1.4648a1,1,0,0,0,.8321-.4453l.8769-1.3154A12.0331,12.0331,0,0,1,26.8945,11H22.82a1,1,0,0,0-.9806.8039l-.7221,4.4708a1,1,0,0,0,.54,1.0539L25,19l.6851,4.0557A11.9793,11.9793,0,0,1,16,28Z"/>
                                        <path fill="none" d="M0 0H32V32H0z" data-name="&lt;Transparent Rectangle>"/>
                                    </svg>
                                </a>
                            </div>
                        @endif
                        @if ($game['social']['instagram'])
                            <div class="w-8 h-8 bg-gray-800 rounded-full flex justify-center items-center">
                                <a href="{{ $game['social']['instagram']['url'] }}" class="hover:text-gray-400">
                                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 32 32"
                                         width="32" height="32">
                                        <title>logo--instagram</title>
                                        <circle cx="22.406" cy="9.594" r="1.44"/>
                                        <path
                                            d="M16,9.8378A6.1622,6.1622,0,1,0,22.1622,16,6.1622,6.1622,0,0,0,16,9.8378ZM16,20a4,4,0,1,1,4-4A4,4,0,0,1,16,20Z"/>
                                        <path
                                            d="M16,6.1622c3.2041,0,3.5837.0122,4.849.07a6.6418,6.6418,0,0,1,2.2283.4132,3.9748,3.9748,0,0,1,2.2774,2.2774,6.6418,6.6418,0,0,1,.4132,2.2283c.0577,1.2653.07,1.6449.07,4.849s-.0122,3.5837-.07,4.849a6.6418,6.6418,0,0,1-.4132,2.2283,3.9748,3.9748,0,0,1-2.2774,2.2774,6.6418,6.6418,0,0,1-2.2283.4132c-1.2652.0577-1.6446.07-4.849.07s-3.5838-.0122-4.849-.07a6.6418,6.6418,0,0,1-2.2283-.4132,3.9748,3.9748,0,0,1-2.2774-2.2774,6.6418,6.6418,0,0,1-.4132-2.2283c-.0577-1.2653-.07-1.6449-.07-4.849s.0122-3.5837.07-4.849a6.6418,6.6418,0,0,1,.4132-2.2283A3.9748,3.9748,0,0,1,8.9227,6.6453a6.6418,6.6418,0,0,1,2.2283-.4132c1.2653-.0577,1.6449-.07,4.849-.07M16,4c-3.259,0-3.6677.0138-4.9476.0722A8.8068,8.8068,0,0,0,8.14,4.63,6.1363,6.1363,0,0,0,4.63,8.14a8.8068,8.8068,0,0,0-.5578,2.9129C4.0138,12.3323,4,12.741,4,16s.0138,3.6677.0722,4.9476A8.8074,8.8074,0,0,0,4.63,23.8605a6.1363,6.1363,0,0,0,3.51,3.51,8.8068,8.8068,0,0,0,2.9129.5578C12.3323,27.9862,12.741,28,16,28s3.6677-.0138,4.9476-.0722a8.8074,8.8074,0,0,0,2.9129-.5578,6.1363,6.1363,0,0,0,3.51-3.51,8.8074,8.8074,0,0,0,.5578-2.9129C27.9862,19.6677,28,19.259,28,16s-.0138-3.6677-.0722-4.9476A8.8068,8.8068,0,0,0,27.37,8.14a6.1363,6.1363,0,0,0-3.51-3.5095,8.8074,8.8074,0,0,0-2.9129-.5578C19.6677,4.0138,19.259,4,16,4Z"/>
                                        <path fill="none" d="M0 0H32V32H0z" data-name="&lt;Transparent Rectangle>"/>
                                    </svg>
                                </a>
                            </div>
                        @endif
                        @if ($game['social']['twitter'])
                            <div class="w-8 h-8 bg-gray-800 rounded-full flex justify-center items-center">
                                <a href="{{ $game['social']['twitter']['url'] }}" class="hover:text-gray-400">
                                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 32 32"
                                         width="32" height="32">
                                        <title>logo--twitter</title>
                                        <path
                                            d="M11.92,24.94A12.76,12.76,0,0,0,24.76,12.1c0-.2,0-.39,0-.59A9.4,9.4,0,0,0,27,9.18a9.31,9.31,0,0,1-2.59.71,4.56,4.56,0,0,0,2-2.5,8.89,8.89,0,0,1-2.86,1.1,4.52,4.52,0,0,0-7.7,4.11,12.79,12.79,0,0,1-9.3-4.71,4.51,4.51,0,0,0,1.4,6,4.47,4.47,0,0,1-2-.56v.05A4.53,4.53,0,0,0,9.5,17.83a4.53,4.53,0,0,1-2,.08A4.51,4.51,0,0,0,11.68,21,9.05,9.05,0,0,1,6.07,23,9.77,9.77,0,0,1,5,22.91a12.77,12.77,0,0,0,6.92,2"/>
                                        <path fill="none" d="M0 0H32V32H0z" data-name="&lt;Transparent Rectangle>"/>
                                    </svg>
                                </a>
                            </div>
                        @endif
                        @if ($game['social']['facebook'])
                            <div class="w-8 h-8 bg-gray-800 rounded-full flex justify-center items-center">
                                <a href="{{ $game['social']['facebook']['url'] }}" class="hover:text-gray-400">
                                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 32 32"
                                         width="32" height="32">
                                        <title>logo--facebook</title>
                                        <path
                                            d="M26.67,4H5.33A1.34,1.34,0,0,0,4,5.33V26.67A1.34,1.34,0,0,0,5.33,28H16.82V18.72H13.7V15.09h3.12V12.42c0-3.1,1.89-4.79,4.67-4.79.93,0,1.86,0,2.79.14V11H22.37c-1.51,0-1.8.72-1.8,1.77v2.31h3.6l-.47,3.63H20.57V28h6.1A1.34,1.34,0,0,0,28,26.67V5.33A1.34,1.34,0,0,0,26.67,4Z"/>
                                        <path fill="none" d="M0 0H32V32H0z" data-name="&lt;Transparent Rectangle>"/>
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </div>

                </div>

                <p class="mt-12">{{ $game['summary'] }}</p>

                <div class="mt-12" x-data="{ isTrailerModalVisible: false}">
                    <button
                        @click="isTrailerModalVisible = true"
                        class="flex bg-blue-500 text-white font-semibold px-4 py-4 hover:bg-blue-600
                        rounded transition ease-in-out duration-150"
                    >
                        <svg class="w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="32"
                             height="32">
                            <title>play--outline</title>
                            <path d="M16,4A12,12,0,1,1,4,16,12,12,0,0,1,16,4m0-2A14,14,0,1,0,30,16,14,14,0,0,0,16,2Z"/>
                            <path
                                d="M12,23a1,1,0,0,1-.51-.14A1,1,0,0,1,11,22V10a1,1,0,0,1,.49-.86,1,1,0,0,1,1,0l11,6a1,1,0,0,1,0,1.76l-11,6A1,1,0,0,1,12,23Zm1-11.32v8.64L20.91,16Z"/>
                            <path fill="none" d="M0 0H32V32H0z" data-name="&lt;Transparent Rectangle>"/>
                        </svg>
                        <span class="ml-2 mt-1">Play Trailer</span>
                    </button>

                    <template x-if="isTrailerModalVisible">
                        <div
                            x-show="isTrailerModalVisible"
                            style="background-color: rgba(0, 0, 0, .5);"
                            class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                        >
                            <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                <div class="bg-gray-900 rounded">
                                    <div class="flex justify-end pr-4 pt-2">
                                        <button
                                            @click="isTrailerModalVisible = false"
                                            @keydown.escape.window="isTrailerModalVisible = false"
                                            class="text-3xl leading-none hover:text-gray-300"
                                        >
                                            &times;
                                        </button>
                                    </div>
                                    <div class="modal-body px-8 py-8">
                                        <div class="responsive-container overflow-hidden relative"
                                             style="padding-top: 56.25%">
                                            <iframe width="560" height="315" class="responsive-iframe absolute top-0
                                                left-0 w-full h-full" src="{{ $game['trailer'] }}"
                                                    style="border:0;" allow="autoplay; encrypted-media" allowfullscreen>
                                            </iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div> <!-- end game-details -->

        <div
            class="images-container border-b border-gray-800 pb-12 mt-8"
            x-data="{ isImageModalVisible: false, image: ''}"
        >
            <h2 class="text-blue-500 uppercase tracking-wide font-semibold">Images</h2>
            <div class="grid grid-cols-1 md:grid-cols-2  lg:grid-cols-3 gap-12 mt-8">
                @foreach ($game['screenshots'] as $screenshot)
                    <div>
                        <a
                            href="#"
                            @click.prevent="
                            isImageModalVisible = true
                            image='{{ $screenshot['huge'] }}'
                                "
                        >
                            <img src="{{ $screenshot['big'] }}"
                                 alt="screenshot"
                                 class="hover:opacity-75 transition ease-in-out duration-150"
                            >
                        </a>
                    </div>
                @endforeach
            </div>
            <template x-if="isImageModalVisible">
                <div
                    style="background-color: rgba(0, 0, 0, .5);"
                    class="z-50 fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                >
                    <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                        <div class="bg-gray-900 rounded">
                            <div class="flex justify-end pr-4 pt-2">
                                <button
                                    class="text-3xl leading-none hover:text-gray-300"
                                    @click="isImageModalVisible = false"
                                    @keydown.escape.window="isImageModalVisible = false"
                                >
                                    &times;
                                </button>
                            </div>
                            <div class="modal-body px-8 py-8">
                                <img :src="image" alt="screenshot">
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div> <!-- end images container -->

        <div class="similar-games-container mt-8">
            <h2 class="text-blue-500 uppercase tracking-wide font-semibold">Similar Games</h2>
            <div class="similar-games text-sm grid grid-cols-1 md:grid-cols2 lg:grid-cols-5 xl:grid-cols-6 gap-12">
                @foreach ($game['similarGames'] as $game)
                    <x-game-card :game="$game"/>
                @endforeach
            </div> <!-- end similar games container -->
@endsection
