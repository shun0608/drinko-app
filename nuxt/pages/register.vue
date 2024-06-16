<template>
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
            type="string"
            v-model="name"
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
            type="string"
            v-model="email"
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
            type="password"
            v-model="password"
            class="input input-bordered w-full max-w-lg"
          />
          <p class="text-error mt-2">{{ passwordError }}</p>
        </label>
        <div class="flex justify-center mt-10">
          <button
            type="button"
            @click="register"
            class="btn btn-block btn-neutral max-w-lg"
          >
            登録
          </button>
        </div>
        <div class="flex flex-col justify-center items-center mt-4">
          <p class="max-w-lg text-gray-400">
            登録ボタンをクリックされると、利用規約および個人情報保護方針に同意されたこととなります。
          </p>
          <back-to-top-link />
        </div>
      </form>
    </template>
  </AuthWhiteBack>
  <div>
    <form>
      <dl>
        <dt>メールアドレス</dt>
        <dd><input v-model="email" type="string" /></dd>
        <dd>
          <p>{{ emailError }}</p>
        </dd>
      </dl>
      <dl>
        <dt>ニックネーム</dt>
        <dd><input v-model="name" type="string" name="name" /></dd>
        <dd>
          <p>{{ nameError }}</p>
        </dd>
      </dl>
      <dl>
        <dt>パスワード</dt>
        <dd><input v-model="password" type="password" /></dd>
        <dd>
          <p>{{ passwordError }}</p>
        </dd>
      </dl>
      <button class="btn" type="button" @click="register">登録</button>
    </form>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useForm, useField } from "vee-validate";
import * as yup from "yup";

const { $apiFetch } = useNuxtApp();
const { $toast } = useNuxtApp();
const router = useRouter();
const { $sanctumAuth } = useNuxtApp();

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
const { value: name, errorMessage: nameError } = useField(
  "name",
  yup.string().required("この項目は必須です")
);
const { value: password, errorMessage: passwordError } = useField(
  "password",
  yup
    .string()
    .required("この項目は必須です")
    .min(8, "８文字以上で入力してください")
);

const login = async () => {
  try {
    await $sanctumAuth.login(
      {
        email: email.value,
        password: password.value,
      },
      () => {
        router.push({ path: "/", query: { registered: "true" } });
      }
    );
  } catch (e) {
    $toast.open({
      message: e.message,
      type: "error",
    });
  }
};

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
      login();
    }
  } catch (e) {
    $toast.open({
      message:
        "登録に失敗しました。お手数ですが、再度ご登録をお願いいたします。",
      type: "error",
    });
  }
};
</script>
