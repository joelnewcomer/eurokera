<?php

class WPML_TM_ATE_Job_Repository {
	/** @var WPML_TM_Jobs_Repository */
	private $job_repository;

	/**
	 * @param WPML_TM_Jobs_Repository $job_repository
	 */
	public function __construct( WPML_TM_Jobs_Repository $job_repository ) {
		$this->job_repository  = $job_repository;
	}

	/**
	 * @return WPML_TM_Jobs_Collection
	 */
	public function get_in_progress() {
		$jobs = $this->job_repository->get( new WPML_TM_Jobs_Search_Params( array(
			'scope'    => WPML_TM_Jobs_Search_Params::SCOPE_LOCAL,
			'status'   => self::get_in_progress_statuses(),
			'job_type' => WPML_TM_Job_Entity::POST_TYPE,
		) ) );

		return $jobs->filter( array( $this, 'is_ate_job' ) );
	}

	/**
	 * @param WPML_TM_Post_Job_Entity $job
	 *
	 * @return bool
	 */
	public function is_ate_job( WPML_TM_Post_Job_Entity $job ) {
		return $job->is_ate_job();
	}

	/** @return array */
	public static function get_in_progress_statuses() {
		return array( ICL_TM_WAITING_FOR_TRANSLATOR, ICL_TM_IN_PROGRESS );
	}
}