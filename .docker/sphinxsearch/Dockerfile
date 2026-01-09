# Ubuntu 16.04 (Xenial) to match Sphinx 2.2.11 era dependencies
FROM ubuntu:16.04 AS builder

# Prevent interactive prompts during build
ENV DEBIAN_FRONTEND=noninteractive

RUN <<EOF
set -ex
apt-get update
apt-get install -y \
    build-essential \
    libmysqlclient-dev \
    wget \
    make
rm -rf /var/lib/apt/lists/*
EOF

WORKDIR /tmp
RUN <<EOF
set -ex
wget http://sphinxsearch.com/files/sphinx-2.2.11-release.tar.gz
tar -zxvf sphinx-2.2.11-release.tar.gz
cd sphinx-2.2.11-release
./configure --prefix=/usr/local --with-mysql
make
make install
rm -rf /tmp/sphinx*
EOF

EXPOSE 9312 9306

RUN mkdir -p /var/log/sphinx \
    && ln -sf /dev/stdout /var/log/sphinx/searchd.log \
    && ln -sf /dev/stderr /var/log/sphinx/query.log

CMD ["searchd", "--nodetach", "--config", "/etc/sphinxsearch/sphinx.conf"]
