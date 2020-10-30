export default {
    methods: {
        openProject(projectid, otherParam, statistics = '') {
            this.goForward({name: 'project-panel', params: {projectid:projectid, statistics: statistics, other:otherParam||{}}});
        },

        outProject(projectid, successCallback) {
            this.$Modal.confirm({
                title: this.$L('退出项目'),
                content: this.$L('你确定要退出此项目吗？'),
                loading: true,
                onOk: () => {
                    $A.apiAjax({
                        url: 'project/out?projectid=' + projectid,
                        error: () => {
                            this.$Modal.remove();
                            alert(this.$L('网络繁忙，请稍后再试！'));
                        },
                        success: (res) => {
                            this.$Modal.remove();
                            typeof successCallback === "function" && successCallback();
                            setTimeout(() => {
                                if (res.ret === 1) {
                                    this.$Message.success(res.msg);
                                }else{
                                    this.$Modal.error({title: this.$L('温馨提示'), content: res.msg });
                                }
                            }, 350);
                        }
                    });
                }
            });
        },

        favorProject(act, projectid, successCallback) {
            $A.apiAjax({
                url: 'project/favor',
                data: {
                    act: act,
                    projectid: projectid,
                },
                error: () => {
                    this.$Modal.remove();
                    alert(this.$L('网络繁忙，请稍后再试！'));
                },
                success: (res) => {
                    this.$Modal.remove();
                    typeof successCallback === "function" && successCallback();
                    setTimeout(() => {
                        if (res.ret === 1) {
                            this.$Message.success(res.msg);
                        }else{
                            this.$Modal.error({title: this.$L('温馨提示'), content: res.msg });
                        }
                    }, 350);
                }
            });
        },

        deleteProject(projectid, successCallback) {
            this.$Modal.confirm({
                title: this.$L('删除项目'),
                content: this.$L('你确定要删除此项目吗？'),
                loading: true,
                onOk: () => {
                    $A.apiAjax({
                        url: 'project/delete?projectid=' + projectid,
                        error: () => {
                            this.$Modal.remove();
                            alert(this.$L('网络繁忙，请稍后再试！'));
                        },
                        success: (res) => {
                            this.$Modal.remove();
                            typeof successCallback === "function" && successCallback();
                            setTimeout(() => {
                                if (res.ret === 1) {
                                    this.$Message.success(res.msg);
                                    $A.triggerTaskInfoListener('deleteproject', {projectid: projectid});
                                }else{
                                    this.$Modal.error({title: this.$L('温馨提示'), content: res.msg });
                                }
                            }, 350);
                        }
                    });
                }
            });
        }
    }
}
