<template>
  <div class="bg-drink relative flex justify-center items-center">
    <div class="bg-white w-full max-w-3xl rounded-3xl px-4 py-6 my-10">
      <h1 class="text-4xl font-bold text-center mt-14">ログイン</h1>
      <form>
        <label class="form-control w-full max-w-lg mx-auto mt-10">
          <div class="label">
            <span class="label-text">メールアドレス</span>
          </div>
          <input
            id="email"
            type="string"
            v-model="email"
            class="input input-bordered w-full max-w-lg"
          />
          <p class="text-error mt-2">{{ emailError }}</p>
        </label>
        <label class="form-control w-full max-w-lg mx-auto mt-4">
          <div class="label">
            <span class="label-text">パスワード</span>
          </div>
          <input
            id="password"
            type="password"
            v-model="password"
            class="input input-bordered w-full max-w-lg"
          />
          <p class="text-error mt-2">{{ passwordError }}</p>
        </label>
        <div class="flex justify-center mt-10">
          <button
            type="button"
            @click="login"
            class="btn btn-block btn-neutral max-w-lg"
          >
            ログイン
          </button>
        </div>
      </form>
      <div class="flex flex-col justify-center items-center mt-6">
        <p class="font-bold">アカウントをお持ちで無い方</p>
        <NuxtLink role="button" class="btn max-w-lg mt-3" href="/register"
          >新規登録（無料）</NuxtLink
        >
        <NuxtLink role="button" class="btn btn-link text-black mt-5" href="/"
          >トップへ戻る</NuxtLink
        >
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useField } from "vee-validate";
import * as yup from "yup";

const router = useRouter();
const { $sanctumAuth } = useNuxtApp();
const { $toast } = useNuxtApp();

definePageMeta({
  middleware: "guest",
});

const { value: email, errorMessage: emailError } = useField(
  "email",
  yup
    .string()
    .required("この項目は必須です")
    .email("メールアドレスの形式で入力してください")
);
const { value: password, errorMessage: passwordError } = useField(
  "password",
  yup.string().required("この項目は必須です")
);

const login = async () => {
  try {
    await $sanctumAuth.login(
      {
        email: email.value,
        password: password.value,
      },
      // optional callback function
      () => {
        router.push({ path: "/", query: { loggedin: "true" } });
      }
    );
  } catch (e) {
    if (e.message) {
      $toast.open({
        message: e.message,
        type: "error",
      });
    } else {
      $toast.open({
        message:
          "ログインできませんでした。メールアドレスまたはパスワードが異なります。",
        type: "error",
      });
    }
  }
};
</script>
