<script setup>
import { useField } from "vee-validate";
import * as yup from "yup";

definePageMeta({
  middleware: "guest",
});

const { $sanctumAuth } = useNuxtApp();
const { $toast } = useNuxtApp();

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
      () => {
        location.href = "/" + "?loggedin=true";
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

<template>
  <div>
    <UseSeoMeta title="ログイン" description="Drinkoログインページ" />
    <AuthWhiteBack>
      <template #form-title>ログイン</template>
      <template #content>
        <form>
          <label class="form-control w-full max-w-lg mx-auto mt-10">
            <div class="label">
              <span class="label-text">メールアドレス</span>
            </div>
            <input
              id="email"
              v-model="email"
              type="string"
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
              v-model="password"
              type="password"
              class="input input-bordered w-full max-w-lg"
            />
            <p class="text-error mt-2">{{ passwordError }}</p>
          </label>
          <div class="flex justify-center mt-10">
            <button
              type="button"
              class="btn btn-block btn-neutral max-w-lg"
              @click="login"
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
          <back-to-top-link />
        </div>
      </template>
    </AuthWhiteBack>
  </div>
</template>
