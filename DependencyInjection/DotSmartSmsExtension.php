<?php

namespace DotSmart\SmsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 */
class DotSmartSmsExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $this->setSsmsParameters(array(
            'reference' => $config['reference'],
            'key'       => $config['key'],
            'senderid'  => $config['senderid'],
            'myid'      => $config['myid'],
            'date'      => $config['date'],
            'time'      => $config['time'],
            'life'      => $config['life'],
            'format'    => $config['format']
        ), $container);
    }

    /**
     * Set parameters to send sms
     *
     * @param $params array filled with sms parameters
     * 
     * @return void
     */
    private function setSsmsParameters(array $params = array(), ContainerBuilder $container)
    {
        if (!is_array($params)) {
            return;
        }

        foreach ($params as $key => $param) {
            if (null === $param || $key === 'senderid') {
                $param = $this->checkParam($key, $param);
            }
            
            $container->setParameter('dot_smart_sms.'.$key, $param);
        }
    }

    /**
     * change some default parameters
     *
     * @param $key string name of parameter
     * @param $param string value of parameter
     *
     * @return mixed date/integer
     */
    private function checkParam($key, $param)
    {
        $getDate = new \DateTime('now');

        switch ($key) {
            case 'date':
                $param = $getDate->format('Y-m-d');
                break;
            case 'time':
                $param = $getDate->format('H:i:s');
                break;
            case 'life':
                $param = null;
                break;
            case 'myid':
                $param = sprintf("%05d", 1);
                break;
            case 'senderid':
                $param = ($param > 12 ? substr($param, 0, 12) : $param);
                break;
        }

        return $param;
    }

    public function getAlias()
    {
        return 'dot_smart_sms';
    }
}
