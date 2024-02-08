pipeline {
    agent any

    stages {
        stage('Push to dockerhub') {
            steps {
                script {
                    sh '''
                    rm -rf gcpapp
                    git clone https://github.com/zefirnikolov/gcpapp-k8scluster.git gcpapp
                    docker image build -t zefirnikolov/web-usapp:2 -f ./gcpapp/webpart-development/Dockerfile ./gcpapp/webpart-development
                    docker push zefirnikolov/web-usapp:2
                    '''
                }
            }
        }
        stage('Deploy to k8s') {
            steps {
                script {
                    sh '''
                    kubectl delete -f ./gcpapp/web.yaml || true
                    kubectl apply -f ./gcpapp/web.yaml
                    '''
                }
            }
        }
    }
}
