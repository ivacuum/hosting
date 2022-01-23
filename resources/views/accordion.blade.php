<details class="border dark:border-slate-700 mb-2 rounded overflow-hidden" itemscope itemtype="http://schema.org/Question">
  <summary class="bg-aa-100 border-b dark:border-b-slate-700 font-medium text-lg px-5 py-2 hover:text-gray-700 dark:text-slate-200 hover:dark:text-slate-400" itemprop="name">{{ $title }}</summary>
  <div class="antialiased px-5 py-3" itemprop="acceptedAnswer" itemscope itemtype="http://schema.org/Answer">
    <div itemprop="text">{{ $slot }}</div>
  </div>
</details>
