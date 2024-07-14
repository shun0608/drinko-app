<script setup>
import { useField } from "vee-validate";
import * as yup from "yup";

const { $apiFetch } = useNuxtApp();
const { $toast } = useNuxtApp();
const showToast = (message, type) => {
  $toast.open({
    message,
    type: type,
  });
};

const { value: email, errorMessage: emailError } = useField(
  "email",
  yup
    .string()
    .required("この項目は必須です")
    .email("メールアドレスの形式で入力してください"),
);
const { value: name, errorMessage: nameError } = useField(
  "name",
  yup.string().required("この項目は必須です"),
);
const { value: password, errorMessage: passwordError } = useField(
  "password",
  yup
    .string()
    .required("この項目は必須です")
    .min(8, "８文字以上で入力してください"),
);

const register = async () => {
  try {
    const response = await $apiFetch("/api/register", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        name: name.value,
        email: email.value,
        password: password.value,
      }),
    });
    if (response.created == true) {
      location.href = "/" + "?registered=true";
    }
  } catch (e) {
    if (e.response._data.message) {
      showToast(e.response._data.message, "error");
    } else {
      showToast(
        "登録に失敗しました。お手数ですが、再度ご登録をお願いいたします。",
        "error",
      );
    }
  }
};
</script>

<template>
  <div>
    <UseSeoMeta
      title="新規ユーザー登録"
      description="Drinkoの新規ユーザー登録ページ。"
    />
    <AuthWhiteBack>
      <template #form-title>新規ユーザー登録</template>
      <template #content>
        <form>
          <label class="form-control w-full max-w-lg mx-auto mt-10">
            <div class="label">
              <span class="label-text"
                >ニックネーム<span class="text-error">*</span></span
              >
            </div>
            <input
              id="name"
              v-model="name"
              type="string"
              class="input input-bordered w-full max-w-lg"
            />
            <p class="text-error mt-2">{{ nameError }}</p>
          </label>
          <label class="form-control w-full max-w-lg mx-auto mt-4">
            <div class="label">
              <span class="label-text"
                >メールアドレス<span class="text-error">*</span></span
              >
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
              <span class="label-text"
                >パスワード<span class="text-error">*</span></span
              >
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
              @click="register"
            >
              登録
            </button>
          </div>
          <div class="flex flex-col justify-center items-center mt-4">
            <p class="max-w-lg text-gray-400">
              登録ボタンをクリックされると、<NuxtLink
                href="/terms-of-use"
                class="underline"
                >利用規約</NuxtLink
              >および
              <NuxtLink href="/privacy-policy" class="underline"
                >プライバシーポリシー</NuxtLink
              >に同意されたこととなります。
            </p>
            <back-to-top-link />
          </div>
        </form>
      </template>
    </AuthWhiteBack>
  </div>
</template>
