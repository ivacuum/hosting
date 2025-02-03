<details class="border border-gray-200 dark:border-slate-700 mb-2 rounded-sm overflow-hidden" itemscope itemtype="https://schema.org/Question">
  <summary class="bg-aa-100 border-b border-gray-200 dark:border-b-slate-700 font-medium text-lg px-5 py-2 hover:text-gray-700 dark:text-slate-200 dark:hover:text-slate-400" itemprop="name">{{ $title }}</summary>
  <div class="px-5 py-3" itemprop="acceptedAnswer" itemscope itemtype="https://schema.org/Answer">
    <div itemprop="text">{{ $slot }}</div>
  </div>
</details>
