<section>
    <div class="container">
        @if($categories->isEmpty())
            <p>No categories found for this year.</p>
        @else
            <ul class="list-disc pl-5 text-gray-900 dark:text-white"">
                @foreach ($categories as $category)
                    <li>{{ $category->category_name }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</section>