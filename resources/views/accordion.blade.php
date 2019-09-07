<details class="border mb-2 rounded overflow-hidden" itemscope itemtype="http://schema.org/Question">
  <summary class="bg-aa-100 border-b font-semibold text-lg px-5 py-3 hover:text-gray-800" itemprop="name">{{ $title }}</summary>
  <div class="antialiased px-5 py-3" itemprop="acceptedAnswer" itemscope itemtype="http://schema.org/Answer">
    <div itemprop="text">{{ $slot }}</div>
  </div>
</details>
