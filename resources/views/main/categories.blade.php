<section>
    <div class="container">
        @if($categories->isEmpty())
            <p class="mt-4">No categories found for this year.</p>
        @else
            <ul class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                @foreach ($categories as $category)
                    <li>{{ $category->category_name }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</section>