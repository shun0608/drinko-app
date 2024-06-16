<script setup>
import { onMounted } from "vue";
const { $toast } = useNuxtApp();
const route = useRoute();
const showToast = (message, type) => {
  $toast.open({
    message,
    type: type,
  });
};

onMounted(() => {
  if (route.query.loggedin === "true") {
    showToast("ログインしました。", "success");
  } else if (route.query.registered === "true") {
    showToast("ユーザー登録が完了しました。", "success");
  } else if (route.query.loggedout === "true") {
    showToast("ログアウトしました。", "success");
  }
});

// const { $sanctumAuth } = useNuxtApp();
// const loading = ref(true);
// const auth = useAuth();
// const router = useRouter();

// onMounted(async () => {
//   try {
//     await $sanctumAuth.getUser();
//     loading.value = false;
//   } catch (e) {
//     console.e("Failed to get user:", error);
//   }
// });
</script>

<template>
  <div class="bg-drink relative">
    <div class="absolute bottom-5 start-4 md:inset-y-2/4 md:start-24">
      <h1 class="text-5xl md:text-8xl font-black">Drinko</h1>
      <h3 class="text-2xl md:text-4xl font-black mt-7">
        丁寧に作ったドリンクで安らぎのひとときを
      </h3>
      <p class="mt-5">
        Drinkoでは、世界各国のソフトドリンクとその作り方を調べることができます。<br />
        検索機能では、あなたの今の気分に合わせて、<br />
        厳選したソフトドリンクをオススメします。<br />
        アルコールが呑めない人にもドリンクの喜びを味わって欲しい。<br />
        そんな願いを込めてつくりました。
      </p>
    </div>
  </div>
  <section class="my-28 px-4">
    <h2 class="text-7xl font-black text-center">Search</h2>
    <h4 class="text-2xl font-black text-center mt-2">ソフトドリンク検索</h4>
    <div class="max-w-3xl mx-auto my-14 px-4 bg-gray-300 rounded-3xl">
      <form action="" class="py-14 mx-auto">
        <label class="form-control w-full max-w-lg mx-auto">
          <div class="label">
            <span class="label-text">フリーワード</span>
          </div>
          <input type="text" class="input input-bordered w-full max-w-lg" />
        </label>
        <label class="form-control w-full max-w-lg mx-auto mt-3">
          <div class="label">
            <span class="label-text">今の気分</span>
          </div>
          <select class="select select-bordered">
            <option selected>今の気分を選んでください</option>
            <option>Star Wars</option>
            <option>Harry Potter</option>
            <option>Lord of the Rings</option>
            <option>Planet of the Apes</option>
            <option>Star Trek</option>
          </select>
        </label>
        <label class="form-control mt-14">
          <button class="btn btn-neutral w-full max-w-lg mx-auto">検索</button>
        </label>
      </form>
    </div>
  </section>
</template>
