<?php

namespace Pantheon\Terminus\Commands\Env;

use Pantheon\Terminus\Commands\TerminusCommand;
use Pantheon\Terminus\Commands\WorkflowProcessingTrait;
use Pantheon\Terminus\Site\SiteAwareInterface;
use Pantheon\Terminus\Site\SiteAwareTrait;

/**
 * Class ClearCacheCommand
 * @package Pantheon\Terminus\Commands\Env
 */
class ClearCacheCommand extends TerminusCommand implements SiteAwareInterface
{
    use SiteAwareTrait;
    use WorkflowProcessingTrait;

    /**
     * Clears caches for the environment.
     *
     * @authorize
     *
     * @command env:clear-cache
     * @aliases env:cc
     *
     * @param string $site_env Site & environment in the format `site-name.env`
     *
     * @usage <site>.<env> Clears caches for <site>'s <env> environment.
     */
    public function clearCache($site_env)
    {
        list($site, $env) = $this->getUnfrozenSiteEnv($site_env);
        $this->processWorkflow($env->clearCache());
        $this->log()->notice('Caches cleared on {site}.{env}.', ['site' => $site->get('name'), 'env' => $env->id,]);
    }
}
