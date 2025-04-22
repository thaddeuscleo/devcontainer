FROM ubuntu:24.04 AS base

ARG USERNAME=ubuntu

# Configure apt
ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=Asia/Jakarta

# RUN add-apt-repository -y ppa:ondrej/php php5.6 php8.2 php7.4
RUN apt update -y
RUN apt install -y git tmux fzf bat  ssh curl zsh sudo software-properties-common
RUN echo $USERNAME ALL=\(root\) NOPASSWD:ALL > /etc/sudoers.d/$USERNAME \
    && chmod 0440 /etc/sudoers.d/$USERNAME

# Install Zioxide
RUN curl -sSfL https://raw.githubusercontent.com/ajeetdsouza/zoxide/main/install.sh | sh

# Install PHP dependencies
RUN add-apt-repository -y ppa:ondrej/php
RUN apt install -y php5.6 php8.2 php7.4

# # Composer 2.3.7
RUN curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer --version=2.3.7

USER ${USERNAME}

WORKDIR /home/${USERNAME}

# Change Shell
RUN sudo chsh -s $(which zsh)

# Install OMZ
RUN sh -c "$(curl -fsSL https://raw.github.com/ohmyzsh/ohmyzsh/master/tools/install.sh)"

# Install P10K
RUN git clone --depth=1 https://github.com/romkatv/powerlevel10k.git /home/${USERNAME}/.oh-my-zsh/custom/themes/powerlevel10k

# Install ZSH Auto Suggestions
RUN git clone https://github.com/zsh-users/zsh-autosuggestions /home/${USERNAME}/.oh-my-zsh/custom/plugins/zsh-autosuggestions

# Copy Configurations
COPY .devcontainer/zshrc /home/${USERNAME}/.zshrc
COPY .devcontainer/p10k.zsh /home/${USERNAME}/.p10k.zsh

ENV SHELL=/bin/zsh

