<!-- vue -->
<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
// optional的寫法
export default {
  components: {
    AuthenticatedLayout,
    Head,
  },
  data() {
    return {
      formData: {
        name: '',
        price: '',
        public: '',
        desc: '',
      },
    };
  },
  methods: {
    submitData() {
      console.log(123);
    },
  },
};
</script>

<!-- 頁面 -->
<template>
  <Head title="Product-Create" />

  <AuthenticatedLayout>
    <template #header>
      <div class="">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Product/Create</h2>

      </div>
    </template>
    <section id="product-create" class="">
      <form @submit.prevent="submitData()" action="" class="product-form">
        {{ formData }}
        <label>
          商品名稱：
          <input v-model="formData.name" type="text" name="name" required>
        </label>
        <label>
          商品價格：
          <input v-model="formData.price" type="number" name="price" required>
        </label>
        <div class="flex">
          <label>
            商品公開：
            <input v-model="formData.public" type="radio" name="public" value="1" required>公開
          </label>
          <label>
            <input v-model="formData.public" type="radio" name="public" value="2">非公開
          </label>
        </div>
        <label>
          商品描述：
          <input v-model="formData.desc" type="text" name="desc" required>
        </label>
        <div class="flex gap-4">
          <!-- 內部Link 外網a -->
          <Link :href="route('product.list')">
            <button type="button" class="btn">取消新增</button>
          </Link>
          <button type="submit" class="btn">新增產品</button>
        </div>
      </form>
    </section>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">You're logged in!</div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<!-- style -->
<style lang="scss" scoped>
#product-create {
    @apply px-12 py-12;
    .product-form {
        @apply flex flex-col gap-5;
    }
    .btn {
        @apply font-semibold text-xl text-gray-800 leading-tight border-black p-2 rounded-sm border-2;
    }
}
</style>