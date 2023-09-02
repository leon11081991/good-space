<template>
  <section class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <Box>
      <h3 class="section-heading text-center">為什麼想做這個專案？</h3>
      <ol class="order-list">
        <li>
          1.
          身邊剛好有朋友是房仲業者，所以想到一個可以建立售屋的資訊，可方便他同一門市的同仁可以自由地新增旗下負責的物件。
        </li>
        <li>2. 最近親戚到處賞屋，需要去計算如果將來購屋，可能會需要的花費。</li>
        <li>3. 因此結合上述兩項原因，開始構思可以整合的平台。</li>
      </ol>
    </Box>
    <Box>
      <h3 class="section-heading text-center">這個專案能做些什麼？</h3>
      <ol class="order-list">
        <li>1. 展示目前正在販售中的房屋（可篩選搜尋）</li>
        <li>2. 註冊 / 登入使用者（區分使用權限）</li>
        <li>3. 使用者可新增房屋資訊</li>
        <li>4. 使用者可在房屋資訊中進行試算</li>
        <li>5. 使用者可針對特定房屋資訊做修改</li>
        <li>6. 使用者可上傳多個房屋圖片</li>
        <li>7. 使用者可對其他興趣的房屋進行出價</li>
        <li>8. 使用者可接受其他人的出價</li>
        <li>9. 收到出價時會顯示通知</li>
      </ol>
    </Box>
  </section>
  <section class="my-5">
    <Box class="bg-slate-200 dark:bg-slate-300 shadow-lg">
      <template #header>還想了解更多嗎？ 歡迎點擊下方連結：）</template>

      <div class="pt-5 flex flex-col sm:flex-row gap-2 w-1/2 sm:w-full mx-auto">
        <a href="" class="btn-normal text-center">我的履歷</a>
        <a href="" class="btn-normal text-center">以往專案</a>
      </div>
      <p class="pt-4 text-xs text-gray-400 text-end">
        This application was made by Leon Chou.
      </p>
    </Box>
  </section>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

import Box from "@/Components/UI/Box.vue";
</script>
