<script>
//  方法一：交給組件送資料
// import { router } from '@inertiajs/vue3';

export default {
  // 組件
  // 組件有結構上差異，建議在新增一個組件
  // props:寫來自於父層傳給子層的資料、接渠道來的東西
  // ex.提供給每張card要顯示的東西
  props: {
    //  方法一：交給組件送資料

    // router,
    // 因為是組件的狀況所以寫清楚
    // 簡寫：
    // productInfo: Object,
    // 小駝峰命名
    // 先申請要拿到什麼資料(可多個資料)
    productInfo: {
      type: Object,
      // 有使用到組件需要資料
      required: true,
      // 預設為...
      // default裡面放fun
      // 簡寫：
      // default: () => {{}},
      default: () => {
        return {};
      },
    },
  },
  emits: ['addCart'],
  data() {
    return {
      num: 1,
    };
  },
  methods: {
    plus() {
      this.num++;
    },
    minus() {
      const { num } = this;
      if (num <= 1) return;
      this.num--;
    },
    inputNum() {
      const { num } = this;
      if (num <= 1) {
        this.num = 1;
      }
    },
    addCart() {
      const { productInfo, num } = this;
      //  方法一：交給組件送資料
      //   router.visit(route('product.addCart'), {
      //     method: 'post',
      //     data: {
      //       id: productInfo.id,
      //       qty: num,
      //     },
      //     preserveStatus: true,
      //   });
      // 方法二：交給引入此組件的頁面去處理
      this.$emit('addCart', { id: productInfo.id, qty: num });
    },
  },

};
</script>

<template>
  <div class="my-product">
    <slot />
    <img :src="productInfo.image_path" class="aspect-[4/3] object-cover" alt="" width="50">
    <!-- 父層接受來自子層的資料 -->
    <p>商品名稱：{{ productInfo.name }}</p>
    <p>商品價格：{{ productInfo.price }}</p>
    <p>商品描述：{{ productInfo.desc }}</p>
    <div class="flex justify-between items-center border-2 border-green-500 rounded-lg">
      <button type="button" class="my-buy-btn" @click="plus()">+</button>
      <input v-model="num" type="number" class="my-buy-btn" @change="inputNum()">
      <button type="button" class="my-buy-btn" @click="minus()">-</button>
    </div>
    <button type="button" class="my-buy-btn" @click="addCart()">加入購物車</button>
    <slot name="msg" />
  </div>
</template>

<style lang="scss" scoped>
.my-product {
    @apply p-6 lg:px-8 flex flex-wrap gap-4 mx-auto justify-center border-2 border-green-500 bg-slate-50 rounded-lg mx-10;
    .my-product-card {
        @apply w-1/4 p-2 border-2 border-green-500 bg-white rounded-md;
    }
    .my-buy-btn {
        @apply p-4 bg-white rounded-md border-0 focus:outline-none focus:ring-0 text-center;
    }
}
</style>
