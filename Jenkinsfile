pipeline {
    agent any

    stages {
        stage('Push to dockerhub') {
            steps {
                script {
                    sh """
                    rm -rf gcpapp
                    git clone https://github.com/zefirnikolov/gcpapp-k8scluster.git gcpapp
                    docker image build -t zefirnikolov/web-usapp:\${BUILD_NUMBER} -f ./gcpapp/webpart-development/Dockerfile ./gcpapp/webpart-development
                    docker push zefirnikolov/web-usapp:\${BUILD_NUMBER}
                    """
                }
            }
        }
        stage('Deploy to k8s') {
            steps {
                script {
                    sh """
                    sed -i 's|zefirnikolov/web-usapp:2|zefirnikolov/web-usapp:\${BUILD_NUMBER}|' ./gcpapp/web.yaml
                    kubectl delete -f ./gcpapp/web.yaml || true
                    kubectl apply -f ./gcpapp/web.yaml
                    """
                }
            }
        }
    }
}
