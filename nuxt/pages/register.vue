<script setup>
import { ref } from "vue";
import { useForm, useField } from "vee-validate";
import * as yup from "yup";
definePageMeta({
  middleware: "guest",
});
const { $apiFetch } = useNuxtApp();

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

const responseMessage = ref("");

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
    console.log(response);
    // console.log(response);
    // if (!response.ok) {
    //   throw new Error("登録に失敗しました。");
    // }
    // const data = await response.json();
    // console.log("Registration successful", data);
  } catch (error) {
    console.error("Error during registration:", error);
  }
};
</script>

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
        <dd><input v-model="name" type="string" /></dd>
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
