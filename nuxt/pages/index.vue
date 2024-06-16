<script setup>
import { onMounted } from "vue";

const { $sanctumAuth } = useNuxtApp();
const loading = ref(true);
const auth = useAuth();
const route = useRoute();
const router = useRouter();
const { $toast } = useNuxtApp();

const showSuccessToast = (message) => {
  $toast.open({
    message,
    type: "success",
  });
};

onMounted(async () => {
  try {
    await $sanctumAuth.getUser();
    loading.value = false;
  } catch (e) {
    console.e("Failed to get user:", error);
  }
});

onMounted(() => {
  if (route.query.loggedin === "true") {
    showSuccessToast("ログインしました。");
  } else if (route.query.registered === "true") {
    showSuccessToast("ユーザー登録が完了しました。");
  } else if (route.query.loggedout === "true") {
    showSuccessToast("ログアウトしました。");
  }
});

const logout = async () => {
  await $sanctumAuth.logout((data) => {
    console.log(data.message);
    router.push({ path: "/", query: { loggedout: "true" } });
    showSuccessToast("ログアウトしました。");
  });
};
</script>

<template>
  <div>
    <div v-if="auth.loggedIn">ログインなう</div>
    <div v-else>ログインしてないよーん</div>
    <a href="/login" class="btn">ログイン</a>
    <button class="btn" @click="logout">ログアウト</button>
    <!-- <div v-if="loggedIn" class="relative">
      <div
        class="absolute inset-0 z-10 flex flex-col items-center justify-center"
      >
        <h1 class="text-black">Drinko</h1>
        <p class="text-black">
          説明説明説明説明説明説明説明説明説明説明説明説明
        </p>
        <a href="#" class="btn">ジュース検索</a>
        <div>
          <p class="text-black">こんにちは{{ user.name }}さん</p>
          <button class="btn" @click="logout">ログアウト</button>
        </div>
      </div>
      <div class="relative">
        <span class="block w-full h-dvh bg-white opacity-50 absolute"></span>
        <img
          src="~/assets/img/keyvisual-pc.jpg"
          alt="キービジュアル"
          class="w-full h-dvh object-cover"
        />
      </div>
    </div>
    <div v-else class="relative">
      <div
        class="absolute inset-0 z-10 flex flex-col items-center justify-center"
      >
        <h1 class="text-black">Drinko</h1>
        <p class="text-black">
          説明説明説明説明説明説明説明説明説明説明説明説明
        </p>
        <a href="/login" class="btn">ログイン</a>
        <a href="#" class="btn">新規登録</a>
        <a href="#" class="btn">ジュース検索</a>
      </div>
      <div class="relative">
        <span class="block w-full h-dvh bg-white opacity-50 absolute"></span>
        <img
          src="~/assets/img/keyvisual-pc.jpg"
          alt="キービジュアル"
          class="w-full h-dvh object-cover"
        />
      </div>
    </div> -->
  </div>
</template>
