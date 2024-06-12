<script setup>
import { useForm } from "vee-validate";
definePageMeta({
  middleware: "guest",
});
const { $apiFetch } = useNuxtApp();

const name = ref("");
const email = ref("");
const password = ref("");
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
        <dd><input v-model="email" type="string" name="email" /></dd>
      </dl>
      <dl>
        <dt>ニックネーム</dt>
        <dd><input v-model="name" type="string" name="name" /></dd>
      </dl>
      <dl>
        <dt>パスワード</dt>
        <dd><input v-model="password" type="password" name="password" /></dd>
      </dl>
      <button class="btn" type="button" @click="register">登録</button>
    </form>
  </div>
</template>
