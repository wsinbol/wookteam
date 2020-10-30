<template>
    <div class="login_body">
        <div class="modal_box">
            <div class="modal_l">
                <img src="../../../statics/images/login_mark_img.png" alt="">
            </div>
            <div class="modal_r">
                <div class="login_title">HI~</div>
                <div class="login_title2">欢迎登录云迈团队协作平台</div>
                <div class="login-header">
                    <div @click="loginType='login'" class="login-header-item" :class="{active:loginType=='login'}">{{$L('用户登录')}}</div>
                    <div v-if="systemConfig.reg=='open'" @click="loginType='reg'" class="login-header-item" :class="{active:loginType=='reg'}">{{$L('注册账号')}}</div>
                </div>
                <Form ref="login" :model="formLogin" :rules="ruleLogin">
                    <FormItem prop="username">
                        <Input type="text" v-model="formLogin.username" size="large" :placeholder="$L('用户名')" @on-enter="onLogin">
                            <Icon type="ios-person-outline" slot="prepend"></Icon>
                        </Input>
                    </FormItem>
                    <FormItem prop="userpass">
                        <Input type="password" v-model="formLogin.userpass" size="large" :placeholder="$L('密码')" @on-enter="onLogin">
                            <Icon type="ios-lock-outline" slot="prepend"></Icon>
                        </Input>
                    </FormItem>
                    <FormItem v-if="loginType=='reg'" prop="userpass2">
                        <Input type="password" v-model="formLogin.userpass2" size="large" :placeholder="$L('确认密码')" @on-enter="onLogin">
                            <Icon type="ios-lock-outline" slot="prepend"></Icon>
                        </Input>
                    </FormItem>
                </Form>
                <div class="modal_btn">
                    <Button type="primary" size="large" :loading="loadIng > 0" @click="onLogin">{{$L(loginType=='reg'?'注册':'登录')}}</Button>
                </div>
            </div>
        </div>
    </div>
</template>
<style lang="scss" scoped>
    .login_body{
        display:flex;
        align-items:center;
        justify-content:center;
        background: url('../../../statics/images/login_bg.jpg') no-repeat center;background-size: cover;
    }
    .modal_box{
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        position: relative;
        max-width: 1200px;width: 80%;height: 65vh;
        max-height: 600px;padding: 10px;
        border-radius: 10px;box-shadow: 0px 0px 10px rgba(0,0,0,.1);
        background:#fff url('../../../statics/images/login_mark_bg.png') no-repeat left bottom;
        background-size:auto 80%;
    }
    .modal_l{
        display: flex;
        width: 58%;
        height: 100%;
        justify-content: center;
        align-items: center;
    }
    .modal_l img{
        display: block;
        width: 90%;
    }
    .modal_r{
        display: block;
        width: 35%;
        margin-right: 5%;
    }
    .modal_btn{
        display: flex;
        align-items: center;
    }
    .modal_btn button{
        width: 100%;
    }
.login_title{font-size: 40px;color: #007aff;font-weight: 600;line-height: 1.4;margin-top: 40px;}
.login_title2{font-size: 30px;color: #007aff;line-height: 1.4;}
    .login-header {
        display: flex;
        align-items: center;
        margin-top: 20px;
        margin-bottom: 20px;
        .login-header-item {
            height: 40px;
            line-height: 40px;
            font-size: 20px;
            color: #444444;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            padding-right: 12px;
            cursor: pointer;
            &.active {
                font-size: 25px;
                color: #2d8cf0;
                font-weight: 500;
            }
        }
    }
</style>
<script>
    export default {
        data () {
            return {
                loadIng: 0,
                loginType: 'login',

                formLogin: {
                    username: '',
                    userpass: '',
                    userpass2: ''
                },
                ruleLogin: {},

                systemConfig: $A.jsonParse($A.storage("systemSetting"), {
                    logo: '',
                    github: '',
                    reg: '',
                }),

                fromUrl: '',
            }
        },
        mounted() {
        },
        methods: {
            onLogin() {
                this.$refs.login.validate((valid) => {
                    if (valid) {
                        this.loadIng++;
                        $A.ajax({
                            url: $A.apiUrl('users/login?type=' + this.loginType),
                            data: this.formLogin,
                            complete: () => {
                                this.loadIng--;
                            },
                            success: (res) => {
                                if (res.ret === 1) {
                                    $A.storage("userInfo", res.data);
                                    $A.setToken(res.data.token);
                                    $A.triggerUserInfoListener(res.data);
                                    //
                                    this.loadIng--;
                                    this.$refs.login.resetFields();
                                    this.$Message.success(this.$L('登录成功'));
                                    if (this.fromUrl) {
                                        window.location.replace(this.fromUrl);
                                    } else {
                                        this.goForward({path: '/todo'}, true);
                                    }
                                } else {
                                    this.$Modal.error({
                                        title: this.$L("温馨提示"),
                                        content: res.msg
                                    });
                                }
                            }
                        })
                    }
                })
            }
        },
    }
</script>
