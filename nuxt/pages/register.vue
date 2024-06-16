<template>
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
